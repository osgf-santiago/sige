<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ordenes_compra;
use Illuminate\Auth\Access\HandlesAuthorization;

class ordenes_compraPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OrdenesCompra');
    }

    public function view(AuthUser $authUser, ordenes_compra $ordenesCompra): bool
    {
        return $authUser->can('View:OrdenesCompra');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OrdenesCompra');
    }

    public function update(AuthUser $authUser, ordenes_compra $ordenesCompra): bool
    {
        return $authUser->can('Update:OrdenesCompra');
    }

    public function delete(AuthUser $authUser, ordenes_compra $ordenesCompra): bool
    {
        return $authUser->can('Delete:OrdenesCompra');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:OrdenesCompra');
    }

    public function restore(AuthUser $authUser, ordenes_compra $ordenesCompra): bool
    {
        return $authUser->can('Restore:OrdenesCompra');
    }

    public function forceDelete(AuthUser $authUser, ordenes_compra $ordenesCompra): bool
    {
        return $authUser->can('ForceDelete:OrdenesCompra');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OrdenesCompra');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OrdenesCompra');
    }

    public function replicate(AuthUser $authUser, ordenes_compra $ordenesCompra): bool
    {
        return $authUser->can('Replicate:OrdenesCompra');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OrdenesCompra');
    }

}