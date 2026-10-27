<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Eventos;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventosPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Eventos');
    }

    public function view(AuthUser $authUser, Eventos $eventos): bool
    {
        return $authUser->can('View:Eventos');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Eventos');
    }

    public function update(AuthUser $authUser, Eventos $eventos): bool
    {
        return $authUser->can('Update:Eventos');
    }

    public function delete(AuthUser $authUser, Eventos $eventos): bool
    {
        return $authUser->can('Delete:Eventos');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Eventos');
    }

    public function restore(AuthUser $authUser, Eventos $eventos): bool
    {
        return $authUser->can('Restore:Eventos');
    }

    public function forceDelete(AuthUser $authUser, Eventos $eventos): bool
    {
        return $authUser->can('ForceDelete:Eventos');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Eventos');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Eventos');
    }

    public function replicate(AuthUser $authUser, Eventos $eventos): bool
    {
        return $authUser->can('Replicate:Eventos');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Eventos');
    }

}