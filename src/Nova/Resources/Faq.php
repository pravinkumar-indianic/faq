<?php

namespace Indianic\FAQManagement\Nova\Resources;

use App\Nova\Resource;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Faq extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\Indianic\FAQManagement\Models\Faq>
     */
    public static $model = \Indianic\FAQManagement\Models\Faq::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            ID::make()->sortable(),

            BelongsTo::make('Category', 'Category', '\Indianic\FAQManagement\Nova\Resources\FaqCategory')
            ->required()
            ->placeholder('Select Category')
            ->sortable(),

            Text::make('Question')
                ->sortable()
                ->rules('required', 'max:255'),

            Trix::make('Answer')
                ->sortable()
                ->required(),
                
            Select::make('Status')
                ->options([
                    1 => 'Active',
                    0 => 'Inactive',
                ])
                ->default(1)
                ->displayUsingLabels()
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
