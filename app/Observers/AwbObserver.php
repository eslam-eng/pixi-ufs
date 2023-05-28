<?php

namespace App\Observers;

use App\Models\Awb;
use Carbon\Carbon;

class AwbObserver
{
    /**
     * Handle the Awb "created" event.
     *
     * @param  \App\Models\Awb  $awb
     * @return void
     */
    public function created(Awb $awb)
    {
        $now = Carbon::now()->format('Y-m-d');
        $awb->update(['code' => $now .$awb->id]);
    }

    /**
     * Handle the Awb "updated" event.
     *
     * @param  \App\Models\Awb  $awb
     * @return void
     */
    public function updated(Awb $awb)
    {
        //
    }

    /**
     * Handle the Awb "deleted" event.
     *
     * @param  \App\Models\Awb  $awb
     * @return void
     */
    public function deleted(Awb $awb)
    {
        //
    }

    /**
     * Handle the Awb "restored" event.
     *
     * @param  \App\Models\Awb  $awb
     * @return void
     */
    public function restored(Awb $awb)
    {
        //
    }

    /**
     * Handle the Awb "force deleted" event.
     *
     * @param  \App\Models\Awb  $awb
     * @return void
     */
    public function forceDeleted(Awb $awb)
    {
        //
    }
}
