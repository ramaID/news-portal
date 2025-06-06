<?php

namespace App\Policies;

use App\Enums\Permission as AppPermissionEnum; // Ganti nama Enum Anda
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->hasRole('admin')) { // Pastikan nama role 'admin' konsisten
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->can(AppPermissionEnum::POST_VIEW);
    }

    public function view(User $user, Post $post): bool
    {
        if ($user->can(AppPermissionEnum::POST_VIEW)) {
            if ($post->status === 'draft' && $post->created_by !== $user->id) {
                return false; // Hanya pemilik (atau admin via before()) yang bisa lihat draft orang lain
            }

            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->can(AppPermissionEnum::POST_CREATE);
    }

    public function update(User $user, Post $post): bool
    {
        return $user->can(AppPermissionEnum::POST_EDIT) && $post->created_by === $user->id;
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->can(AppPermissionEnum::POST_DELETE) && $post->created_by === $user->id;
    }

    public function publish(User $user, Post $post): bool
    {
        return $user->can(AppPermissionEnum::POST_PUBLISH); // Logika kepemilikan bisa ditambahkan jika perlu
    }

    public function restore(User $user, Post $post): bool
    {
        return $user->can(AppPermissionEnum::POST_EDIT) && $post->created_by === $user->id; // Contoh
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return false; // Biasanya hanya admin (sudah dihandle oleh before())
    }
}
