<?php

namespace App\Nova\Dashboards;

use Coroowicaksono\ChartJsIntegration\StackedChart;
use Coroowicaksono\ChartJsIntegration\BarChart;
use Coroowicaksono\ChartJsIntegration\LineChart;
use Coroowicaksono\ChartJsIntegration\DoughnutChart;

use App\Nova\Metrics\ClientsPerRole;
use App\Nova\Metrics\ProposalsByInclusionWay;
use App\Nova\Metrics\ProposalsPerRole;
use App\Nova\Metrics\TopAtendentes;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        $process_statuses= [
            ["label"=>"0" ,"color" => "#007BFF"],
            ['label'=>'2' ,'color' => '#28A645'],
            ['label'=>'6' ,'color' => '#DC3544']
        ];
        $series = [];
        foreach ($process_statuses as $status){

            $new_serie = [
                'label' => $status['label'],
                'filter'=>[
                    'key'=>'id_status_administrativo',
                    'value'=>$status['label']
                ],
                'barPercentage' => 0.5,
                'backgroundColor' => $status['color'],
            ];

            $series = [...$series,$new_serie];
        }
        
        return [
            new ClientsPerRole(),
            (new ProposalsPerRole)->width('1/3'),
            new ProposalsByInclusionWay(),
            // new TopAtendentes(),
            (new BarChart())
                ->title('Revenue')
                ->model('\App\Models\Proposal') // Use Your Model Here
                ->col_xaxis('data_solicitacao_proposta')
                ->series($series)
                ->options([
                    'btnRefresh' => true,
                    'uom' => 'hour',
                    'btnFilter' => true,
                    'btnFilterDefault' => 'YTD',
                    'btnFilterList' => [
                        'YTD'   => 'Year to Date',
                        'QTD'   => 'Quarter to Date',
                        'MTD'   => 'Month to Date',
                        '30'   => '30 Days', // numeric key will be set to days
                        '28'   => '28 Days', // numeric key will be set to days
                    ],
                ])
                ->width('2/3'),
        ];
    }
}
