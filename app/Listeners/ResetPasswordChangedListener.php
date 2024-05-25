<?php

namespace App\Listeners;

use App\Notifications\ResetPasswordChangedNotification;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordChangedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PasswordReset $event): void
    {
        $event->user->notify(new ResetPasswordChangedNotification);
    }
}
