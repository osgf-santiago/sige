<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Bienes;
use Illuminate\Auth\Access\HandlesAuthorization;

class BienesPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Bienes');
    }

    public function view(AuthUser $authUser, Bienes $bienes): bool
    {
        return $authUser->can('View:Bienes');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Bienes');
    }

    public function update(AuthUser $authUser, Bienes $bienes): bool
    {
        return $authUser->can('Update:Bienes');
    }

    public function delete(AuthUser $authUser, Bienes $bienes): bool
    {
        return $authUser->can('Delete:Bienes');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Bienes');
    }

    public function restore(AuthUser $authUser, Bienes $bienes): bool
    {
        return $authUser->can('Restore:Bienes');
    }

    public function forceDelete(AuthUser $authUser, Bienes $bienes): bool
    {
        return $authUser->can('ForceDelete:Bienes');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Bienes');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Bienes');
    }

    public function replicate(AuthUser $authUser, Bienes $bienes): bool
    {
        return $authUser->can('Replicate:Bienes');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Bienes');
    }

}