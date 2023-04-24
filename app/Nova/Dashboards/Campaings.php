<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\CampaignsByAttractionWay;
use App\Nova\Metrics\CampaignsByContactWay;
use Laravel\Nova\Dashboard;

class Campaings extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new CampaignsByAttractionWay(),
            new CampaignsByContactWay()
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'campaings';
    }

    public function name() {
        return 'Campanhas';
    }
}
