<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Greg0x46\MaskedField\MaskedField;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;

class ClientsPreRegister extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ClientsPreRegister>
     */
    public static $model = \App\Models\ClientsPreRegister::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nome';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nome', 'cpf', 'telefone'
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
            Text::make('nome')->sortable(),
            MaskedField::make('cpf')
                ->mask('###.###.###-##')
                ->displayUsing(function ($value) {
                    return substr($value, 0, 3) . '.' . // XXX.
                        substr($value, 3, 3) . '.' . // XXX.XXX.
                        substr($value, 6, 3) . '-' . // XXX.XXX.XXX-
                        substr($value, 9, 2);        // XXX.XXX.XXX-XX
                })
                ->sortable(),
            MaskedField::make('telefone')
                ->mask('(##) # ####-####')
                ->displayUsing(function ($value) {
                    if (strlen($value) == 11) {
                        return '(' . substr($value, 0, 2) . ') ' . // (XX)
                            substr($value, 2, 1) . ' ' . // (XX) X 
                            substr($value, 3, 4) . '-' . // (XX) X XXXX-
                            substr($value, 7, 4);        // (XX) X XXXX-XXXX
                    } else {
                        return '(' . substr($value, 0, 2) . ') ' . // (XX)
                            substr($value, 2, 4) . ' ' . // (XX) XXXX-
                            substr($value, 6, 4);        // (XX) XXXX-XXXX
                    }
                })
                ->sortable(),
                Date::make('Data Cadastro', 'created_at')->sortable(),
                BelongsToMany::make('Campanhas', 'campanhas', 'App\Nova\Campaign')
                ->fields(function () {
                    return [
                        Text::make('Hash'),
                    ];
                }),
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
        return [];
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
