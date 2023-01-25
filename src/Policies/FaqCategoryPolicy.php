<?php
namespace Indianic\FAQManagement\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FaqCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any faq category.
     *
     * @param Admin $user
     * @return bool
     */
    public function viewAny(Admin $user): bool
    {
        return $user->hasPermissionTo('view faq-category');
    }

    /**
     * Determine whether the user can view the faq category.
     *
     * @param Admin $user
     * @return bool
     */
    public function view(Admin $user): bool
    {
        return $user->hasPermissionTo('view faq-category');
    }

    /**
     * Determine whether the user can create faq category.
     *
     * @param Admin $user
     * @return bool
     */
    public function create(Admin $user): bool
    {
        return ( $user->hasPermissionTo('update faq-category'));
    }

    /**
     * Determine whether the user can update the faq category.
     *
     * @param Admin $user
     * @return bool
     */
    public function update(Admin $user): bool
    {
        return $user->hasPermissionTo('update faq-category');
    }

    /**
     * Determine whether the user can delete the faq category.
     *
     * @return Response|bool
     */
    public function delete(): Response|bool
    {
        return $user->hasPermissionTo('delete faq-category');
    }
}
