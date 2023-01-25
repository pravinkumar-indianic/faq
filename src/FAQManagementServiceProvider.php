<?php

namespace Indianic\FAQManagement;

use Indianic\FAQManagement\Nova\Resources\Faq;
// use Indianic\FAQManagement\Policies\FaqPolicy;
// use Indianic\FAQManagement\Policies\FaqCategoryPolicy;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;

class FAQManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setModulePermissions();

        // Gate::policy(\Indianic\FAQManagement\Models\Faq::class, FaqPolicy::class);
        // Gate::policy(\Indianic\FAQManagement\Models\FaqCategory::class, FaqCategoryPolicy::class);

        Nova::serving(function (ServingNova $event) {

            Nova::resources([
                Faq::class,
                FaqCategory::class,
            ]);
        });

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Set Faq Management module permissions
     *
     * @return void
     */
    private function setModulePermissions()
    {
        $existingPermissions = config('nova-permissions.permissions');

        //FAQ category permissions
        $existingPermissions['view faq-category'] = [
            'display_name' => 'View faq category',
            'description'  => 'Can view faq category',
            'group'        => 'Faq Category'
        ];

        $existingPermissions['create faq-management'] = [
            'display_name' => 'Create faq category',
            'description'  => 'Can create faq category',
            'group'        => 'Faq Category'
        ];

        $existingPermissions['update faq-category'] = [
            'display_name' => 'Update faq category',
            'description'  => 'Can update faq category',
            'group'        => 'Faq Category'
        ];

        $existingPermissions['delete faq-category'] = [
            'display_name' => 'Delete faq category',
            'description'  => 'Can delete faq category',
            'group'        => 'Faq Category'
        ];

        //FAQ management permissions
        $existingPermissions['view faq-management'] = [
            'display_name' => 'View faq management',
            'description'  => 'Can view faq management',
            'group'        => 'Faq Management'
        ];

        $existingPermissions['create faq-management'] = [
            'display_name' => 'Create faq management',
            'description'  => 'Can create faq management',
            'group'        => 'Faq Management'
        ];

        $existingPermissions['update faq-management'] = [
            'display_name' => 'Update faq management',
            'description'  => 'Can update faq management',
            'group'        => 'Faq Management'
        ];

        $existingPermissions['delete faq-management'] = [
            'display_name' => 'Delete faq management',
            'description'  => 'Can delete faq management',
            'group'        => 'Faq Management'
        ];

        Config::set('nova-permissions.permissions', $existingPermissions);
    }
}
