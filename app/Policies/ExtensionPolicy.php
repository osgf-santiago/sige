<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Extension;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExtensionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Extension');
    }

    public function view(AuthUser $authUser, Extension $extension): bool
    {
        return $authUser->can('View:Extension');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Extension');
    }

    public function update(AuthUser $authUser, Extension $extension): bool
    {
        return $authUser->can('Update:Extension');
    }

    public function delete(AuthUser $authUser, Extension $extension): bool
    {
        return $authUser->can('Delete:Extension');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Extension');
    }

    public function restore(AuthUser $authUser, Extension $extension): bool
    {
        return $authUser->can('Restore:Extension');
    }

    public function forceDelete(AuthUser $authUser, Extension $extension): bool
    {
        return $authUser->can('ForceDelete:Extension');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Extension');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Extension');
    }

    public function replicate(AuthUser $authUser, Extension $extension): bool
    {
        return $authUser->can('Replicate:Extension');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Extension');
    }

}