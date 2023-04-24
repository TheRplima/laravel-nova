<?php

namespace App\Nova\Metrics;

use App\Models\Campaign;
use App\Models\ContactWayCampaign;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class CampaignsByContactWay extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Campaign::with('forma_contato'), 'id_forma_contato_campanha')
            ->label(function ($value) {
                return ContactWayCampaign::find($value)->descricao;
            });
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
        return 'campaigns-by-contact-way';
    }
}
