<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Visitas;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitasPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Visitas');
    }

    public function view(AuthUser $authUser, Visitas $visitas): bool
    {
        return $authUser->can('View:Visitas');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Visitas');
    }

    public function update(AuthUser $authUser, Visitas $visitas): bool
    {
        return $authUser->can('Update:Visitas');
    }

    public function delete(AuthUser $authUser, Visitas $visitas): bool
    {
        return $authUser->can('Delete:Visitas');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Visitas');
    }

    public function restore(AuthUser $authUser, Visitas $visitas): bool
    {
        return $authUser->can('Restore:Visitas');
    }

    public function forceDelete(AuthUser $authUser, Visitas $visitas): bool
    {
        return $authUser->can('ForceDelete:Visitas');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Visitas');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Visitas');
    }

    public function replicate(AuthUser $authUser, Visitas $visitas): bool
    {
        return $authUser->can('Replicate:Visitas');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Visitas');
    }

}