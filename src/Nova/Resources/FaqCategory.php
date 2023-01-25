<?php

namespace Indianic\FAQManagement\Nova\Resources;

use App\Nova\Resource;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class FaqCategory extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\Indianic\FAQManagement\Models\FaqCategory>
     */
    public static string $model = \Indianic\FAQManagement\Models\FaqCategory::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'subject'
    ];

    /**
     * Return the location to redirect the user after update.
     *
     * @param NovaRequest $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return string
     */
//    public static function redirectAfterUpdate(NovaRequest $request, $resource): string
//    {
//        return '/resources/'.static::uriKey();
//    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),
            Slug::make('Slug')->from('Name'),
            Select::make('Status')
                ->options([
                    1 => 'Active',
                    0 => 'Inactive',
                ])
                ->default(1)
                ->displayUsingLabels(),
            HasMany::make('Faqs')
        ];
    }

    public function fieldsForUpdate(NovaRequest $request): array
    {
        return $this->fieldsForCreate($request);
    }

    /**
     * Get the fields for create form.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fieldsForCreate(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Category', 'Category', 'App\Nova\FaqCategory')
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
     * Find the all events for the dropdown options
     *
     * @return array
     */
    private function findEventsInPath(): array
    {
        $files = [];
        $path = app_path('Events');
        $iterator = new \RecursiveDirectoryIterator($path);

        foreach (new \RecursiveIteratorIterator($iterator) as $file) {
            if (!Str::endsWith($file->getRealPath(), '.php')) {
                continue;
            }

            $fp = fopen($file->getRealPath(), 'r');
            $buffer = fread($fp, 512);

            // find the name space
            preg_match("/namespace (.*)/", $buffer, $matches);
            $namespace = str_replace(';', '\\', $matches[1]);

            // find the class name
            preg_match("/class (.*)/", $buffer, $matches);
            $className = $matches[1];

            $files[$namespace . $className] = $this->getReadableName($className);
        }
        return $files;
    }

    /**
     * @param $name
     * @return string
     */
    private function getReadableName($name): string
    {
        preg_match_all('/((?:^|[A-Z])[a-z]+)/', $name,$matches);
        return implode(' ', $matches[0]);
    }
}
