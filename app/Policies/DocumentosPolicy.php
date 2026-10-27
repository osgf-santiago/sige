<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Documentos;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentosPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Documentos');
    }

    public function view(AuthUser $authUser, Documentos $documentos): bool
    {
        return $authUser->can('View:Documentos');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Documentos');
    }

    public function update(AuthUser $authUser, Documentos $documentos): bool
    {
        return $authUser->can('Update:Documentos');
    }

    public function delete(AuthUser $authUser, Documentos $documentos): bool
    {
        return $authUser->can('Delete:Documentos');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Documentos');
    }

    public function restore(AuthUser $authUser, Documentos $documentos): bool
    {
        return $authUser->can('Restore:Documentos');
    }

    public function forceDelete(AuthUser $authUser, Documentos $documentos): bool
    {
        return $authUser->can('ForceDelete:Documentos');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Documentos');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Documentos');
    }

    public function replicate(AuthUser $authUser, Documentos $documentos): bool
    {
        return $authUser->can('Replicate:Documentos');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Documentos');
    }

}