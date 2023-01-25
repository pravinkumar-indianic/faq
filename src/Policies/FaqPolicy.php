<?php
namespace Indianic\FAQManagement\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FaqPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any faq management.
     *
     * @param Admin $user
     * @return bool
     */
    public function viewAny(Admin $user): bool
    {
        return $user->hasPermissionTo('view faq-management');
    }

    /**
     * Determine whether the user can view the faq management.
     *
     * @param Admin $user
     * @return bool
     */
    public function view(Admin $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create faq management.
     *
     * @param Admin $user
     * @return bool
     */
    public function create(Admin $user): bool
    {
        return ( $user->hasPermissionTo('update faq-management'));
    }

    /**
     * Determine whether the user can update the faq management.
     *
     * @param Admin $user
     * @return bool
     */
    public function update(Admin $user): bool
    {
        return $user->hasPermissionTo('update faq management');
    }

    /**
     * Determine whether the user can delete the faq management.
     *
     * @return Response|bool
     */
    public function delete(): Response|bool
    {
        return false;
    }
}
