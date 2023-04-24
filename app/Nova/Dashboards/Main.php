<?php

namespace App\Nova\Dashboards;

use Coroowicaksono\ChartJsIntegration\StackedChart;
use Coroowicaksono\ChartJsIntegration\BarChart;
use Coroowicaksono\ChartJsIntegration\LineChart;
use Coroowicaksono\ChartJsIntegration\DoughnutChart;

// use App\Nova\Metrics\ClientsPerRole;
use App\Nova\Metrics\ProposalsByDay;
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
        return [
            // new ClientsPerRole(),
            new ProposalsPerRole(),
            new ProposalsByDay(),
            new ProposalsByInclusionWay(),
            new TopAtendentes(),
        ];
    }
}
