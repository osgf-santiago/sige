<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Articulos;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticulosPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Articulos');
    }

    public function view(AuthUser $authUser, Articulos $articulos): bool
    {
        return $authUser->can('View:Articulos');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Articulos');
    }

    public function update(AuthUser $authUser, Articulos $articulos): bool
    {
        return $authUser->can('Update:Articulos');
    }

    public function delete(AuthUser $authUser, Articulos $articulos): bool
    {
        return $authUser->can('Delete:Articulos');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Articulos');
    }

    public function restore(AuthUser $authUser, Articulos $articulos): bool
    {
        return $authUser->can('Restore:Articulos');
    }

    public function forceDelete(AuthUser $authUser, Articulos $articulos): bool
    {
        return $authUser->can('ForceDelete:Articulos');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Articulos');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Articulos');
    }

    public function replicate(AuthUser $authUser, Articulos $articulos): bool
    {
        return $authUser->can('Replicate:Articulos');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Articulos');
    }

}