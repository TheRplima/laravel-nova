<?php

namespace App\Nova;

use App\Nova\Metrics\CampaignsByAttractionWay;
use App\Nova\Metrics\CampaignsByContactWay;
use App\Nova\Metrics\PreClientsByPeriod;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Campaign extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Campaign>
     */
    public static $model = \App\Models\Campaign::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'descricao';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id_campanha', 'descricao'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Descricao', 'descricao'),
            BelongsTo::make('Forma de contato', 'forma_contato', 'App\Nova\ContactWayCampaign'),
            Date::make('Data Criação','created_at'),
            BelongsToMany::make('Forma de Captação', 'formas_capitacao', 'App\Nova\AttractionWay')
                ->fields(function () {
                    return [
                        Text::make('Hash'),
                    ];
                }),
            HasMany::make('Pré Clientes','pre_clientes', 'App\Nova\ClientsPreRegister')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new CampaignsByAttractionWay(),
            new CampaignsByContactWay(),
            new PreClientsByPeriod()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
