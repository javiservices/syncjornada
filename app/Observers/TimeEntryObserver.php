<?php

namespace App\Observers;

use App\Models\TimeEntry;

class TimeEntryObserver
{
    /**
     * Handle the TimeEntry "created" event.
     */
    public function created(TimeEntry $timeEntry): void
    {
        //
    }

    /**
     * Handle the TimeEntry "updated" event.
     */
    public function updated(TimeEntry $timeEntry): void
    {
        //
    }

    /**
     * Handle the TimeEntry "deleted" event.
     */
    public function deleted(TimeEntry $timeEntry): void
    {
        //
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
