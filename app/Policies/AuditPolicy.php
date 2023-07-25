<?php

namespace App\Policies;

use App\Models\User;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Auth\Access\Response;

class AuditPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny audits');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Audit $audit): bool
    {
        return $user->can('view audits');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create audits');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Audit $audit): bool
    {
        return $user->can('edit audits');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Audit $audit): bool
    {
        return $user->can('delete audits');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Audit $audit): bool
    {
        return $user->can('restore audits');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Audit $audit): bool
    {
        return $user->can('forceDelete audits');
    }
}
