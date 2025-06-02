<?php

namespace App\Policies;

use App\Enums\Permission as AppPermissionEnum;
use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        // Admin dengan izin moderasi bisa melakukan banyak hal terkait komentar
        if ($user->hasRole('admin') && $user->can(AppPermissionEnum::COMMENT_MODERATE)) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->can(AppPermissionEnum::COMMENT_VIEW);
    }

    public function view(User $user, Comment $comment): bool
    {
        return $user->can(AppPermissionEnum::COMMENT_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->can(AppPermissionEnum::COMMENT_CREATE);
    }

    public function update(User $user, Comment $comment): bool
    {
        // Hanya pemilik komentar yang bisa update, atau moderator (via before())
        return $user->can(AppPermissionEnum::COMMENT_EDIT) && $comment->created_by === $user->id;
    }

    public function delete(User $user, Comment $comment): bool
    {
        // Hanya pemilik komentar yang bisa delete, atau moderator (via before())
        return $user->can(AppPermissionEnum::COMMENT_DELETE) && $comment->created_by === $user->id;
    }
}
