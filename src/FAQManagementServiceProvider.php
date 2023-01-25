<?php
namespace Indianic\FAQManagement;

use Indianic\FAQManagement\Nova\Resources\Faq;
use Indianic\FAQManagement\Policies\FaqPolicy;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;

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

        Gate::policy(\Indianic\FAQManagement\Models\Faq::class, FaqPolicy::class);

        Nova::serving(function (ServingNova $event) {

            Nova::resources([
                Faq::class,
            ]);

        });

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // listen to all the events through FAQManagementEventListener
        // Event::listen('*', FAQManagementEventListener::class);
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

        \Config::set('nova-permissions.permissions', $existingPermissions);
    }
}
