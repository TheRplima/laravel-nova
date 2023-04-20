<?php

namespace App\Nova\Metrics;

use App\Models\Attendant;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

use App\Models\Proposal;
use Illuminate\Support\Facades\DB;

class TopAtendentes extends Table
{

    /**
     * The width of the card (1/3, 2/3, 1/2, 1/4, 3/4, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {

        // $attendants = Attendant::withCount('proposals')->take(10)->get();

        // $finishedProposals = $attendants->flatMap(function ($attendant) {
        //     return [
        //         $attendant->nome => $attendant->proposals_count
        //     ];
        // })->toArray();
        // $ret = [];
        // foreach ($attendants as $proposal){
        //     $ret[] = MetricTableRow::make()
        //         ->icon('check-circle')
        //         ->iconClass('text-green-500')
        //         ->title($proposal->nome.' ('.$proposal->proposals_count.')');  
        // }

        // return $ret;

        $finishedProposals = Proposal::with(['attendant'])
        ->select([
            'cad_usuario.nome',
            DB::raw('count(cad_proposta.id_proposta) as qtde_propostas')
        ])
        ->whereRaw("cad_proposta.id_usuario is not null and cad_proposta.id_status_administrativo = 6 and cad_proposta.data_solicitacao_proposta between '2023-03-01 00:00:00' and '2023-03-31 23:59:59'")
        ->join('cad_usuario', 'cad_usuario.id_usuario', '=', 'cad_proposta.id_usuario')
        ->groupBy('cad_proposta.id_usuario','cad_usuario.nome')
        ->orderByDesc('qtde_propostas')
        ->take(10)
        ->get();
        $ret = [];
        foreach ($finishedProposals as $proposal){
            $ret[] = MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title($proposal->nome.' ('.$proposal->qtde_propostas.')');  
        }

        return $ret;

    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }
}
