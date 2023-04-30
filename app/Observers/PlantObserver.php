<?php

namespace App\Observers;

use App\Models\Plant;
use Illuminate\Support\Facades\Auth;

class PlantObserver
{
    /**
     * Handle the Plant "created" event.
     */
    public function created(Plant $plant): void
    {
        //
    }

    /**
     * Handle the Plant "updated" event.
     */
    public function updated(Plant $plant): void
    {
        //
    }

    public function updating(Plant $plant): void
    {
        abort_if($plant->owner->getKey() === Auth::user()->getKey(), 403, 'Unable to be the guardian of your plant');
    }

    /**
     * Handle the Plant "deleted" event.
     */
    public function deleted(Plant $plant): void
    {
        //
    }

    /**
     * Handle the Plant "restored" event.
     */
    public function restored(Plant $plant): void
    {
        //
    }

    /**
     * Handle the Plant "force deleted" event.
     */
    public function forceDeleted(Plant $plant): void
    {
        //
    }
}
