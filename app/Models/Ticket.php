<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::saving(function (Ticket $ticket) {
            // Matriz de Prioridad ITIL básica
            if ($ticket->impacto === 'alto' && $ticket->urgencia === 'alto') {
                $ticket->prioridad = 'critico';
            } elseif ($ticket->impacto === 'alto' || $ticket->urgencia === 'alto') {
                $ticket->prioridad = 'alto';
            } elseif ($ticket->impacto === 'medio' || $ticket->urgencia === 'medio') {
                $ticket->prioridad = 'medio';
            } else {
                $ticket->prioridad = 'bajo';
            }

            // Registrar timestamp de resolución
            if ($ticket->isDirty('estatus') && $ticket->estatus === 'resuelto' && is_null($ticket->resuelto)) {
                $ticket->resuelto = now();
            }
        });
    }

    public function area(): BelongsTo { return $this->belongsTo(Area::class); }
    public function client(): BelongsTo { return $this->belongsTo(User::class, 'user_id'); }
    public function agent(): BelongsTo { return $this->belongsTo(User::class, 'assigned_to'); }
    public function histories(): HasMany { return $this->hasMany(TicketHistory::class); }
}