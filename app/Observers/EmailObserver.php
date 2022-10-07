<?php

namespace App\Observers;

use App\Jobs\ProcessEmailJob;
use App\Models\Email;
use Carbon\Carbon;

class EmailObserver
{
    /**
     * Handle the Email "created" event.
     *
     * @param  \App\Models\Email  $email
     * @return void
     */
    public function created(Email $email)
    {
        ProcessEmailJob::dispatch($email)
            ->delay(now()->diffInSeconds($email->schedule));
    }

    /**
     * Handle the Email "updated" event.
     *
     * @param  \App\Models\Email  $email
     * @return void
     */
    public function updated(Email $email)
    {
        //
    }

    /**
     * Handle the Email "deleted" event.
     *
     * @param  \App\Models\Email  $email
     * @return void
     */
    public function deleted(Email $email)
    {
        //
    }

    /**
     * Handle the Email "restored" event.
     *
     * @param  \App\Models\Email  $email
     * @return void
     */
    public function restored(Email $email)
    {
        //
    }

    /**
     * Handle the Email "force deleted" event.
     *
     * @param  \App\Models\Email  $email
     * @return void
     */
    public function forceDeleted(Email $email)
    {
        //
    }
}
