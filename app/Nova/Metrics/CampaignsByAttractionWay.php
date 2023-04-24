<?php

namespace App\Nova\Metrics;

use App\Models\AttractionWay;
use App\Models\AttractionWayCampaign;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class CampaignsByAttractionWay extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {

        $AttractionWayCampaigns = AttractionWayCampaign::select([
            'cfc.descricao AS descricao',
            DB::raw('count(cad_forma_capitacao_campanha.id_campanha) AS campanhas_count')
        ])
        ->join('cad_forma_capitacao AS cfc', 'cad_forma_capitacao_campanha.id_forma_capitacao', '=', 'cfc.id_forma_capitacao')
        ->join('cad_campanha AS cc', 'cad_forma_capitacao_campanha.id_campanha', '=', 'cc.id_campanha')
        ->groupBy('cfc.descricao')
        ->orderByDesc('campanhas_count')
        ->get();

        return $this->result(
            $AttractionWayCampaigns->flatMap(function ($AttractionWayCampaign) {
                return [
                    $AttractionWayCampaign->descricao => $AttractionWayCampaign->campanhas_count
                ];
            })->toArray()
        );
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

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'campaigns-by-attraction-way';
    }

    public function name()
    {
        return 'Campanhas por forma de captação';
    }
}
