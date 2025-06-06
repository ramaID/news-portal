<?php

namespace App\Policies;

use App\Enums\Permission;
use App\Models\Topic;
use App\Models\User;

class TopicPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(Permission::TOPIC_VIEW);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Topic $topic): bool
    {
        return $user->can(Permission::TOPIC_VIEW);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(Permission::TOPIC_CREATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Topic $topic): bool
    {
        return $user->can(Permission::TOPIC_EDIT);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Topic $topic): bool
    {
        return $user->can(Permission::TOPIC_DELETE);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Topic $topic): bool
    {
        // Atau gunakan permission terpisah jika perlu
        return $user->can(Permission::TOPIC_EDIT);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Topic $topic): bool
    {
        // Biasanya hanya super admin (sudah di-handle oleh 'before')
        return false;
    }
}
