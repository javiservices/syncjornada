<?php

namespace App\Observers;

use App\Models\TimeEntry;
use App\Models\TimeEntryAudit;

class TimeEntryObserver
{
    /**
     * Handle the TimeEntry "created" event.
     */
    public function created(TimeEntry $timeEntry): void
    {
        TimeEntryAudit::create([
            'time_entry_id' => $timeEntry->id,
            'user_id' => auth()->id() ?? $timeEntry->user_id,
            'action' => 'created',
            'old_values' => null,
            'new_values' => $timeEntry->getAttributes(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Handle the TimeEntry "updated" event.
     */
    public function updated(TimeEntry $timeEntry): void
    {
        // No auditar si el registro está bloqueado (no debería llegar aquí, pero por seguridad)
        if ($timeEntry->is_locked) {
            return;
        }

        TimeEntryAudit::create([
            'time_entry_id' => $timeEntry->id,
            'user_id' => auth()->id() ?? $timeEntry->user_id,
            'action' => 'updated',
            'old_values' => $timeEntry->getOriginal(),
            'new_values' => $timeEntry->getChanges(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Handle the TimeEntry "deleting" event (before deletion).
     */
    public function deleting(TimeEntry $timeEntry): void
    {
        TimeEntryAudit::create([
            'time_entry_id' => $timeEntry->id,
            'user_id' => auth()->id() ?? $timeEntry->user_id,
            'action' => 'deleted',
            'old_values' => $timeEntry->getAttributes(),
            'new_values' => null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Handle the TimeEntry "deleted" event.
     */
    public function deleted(TimeEntry $timeEntry): void
    {
        // La auditoría ya se creó en deleting()
    }

    /**
     * Handle the TimeEntry "restored" event.
     */
    public function restored(TimeEntry $timeEntry): void
    {
        //
    }

    /**
     * Handle the TimeEntry "force deleted" event.
     */
    public function forceDeleted(TimeEntry $timeEntry): void
    {
        //
    }
}
