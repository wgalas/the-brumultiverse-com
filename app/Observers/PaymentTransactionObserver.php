<?php

namespace App\Observers;

use App\Models\PaymentTransaction;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Notification;

class PaymentTransactionObserver
{
    public function updated(PaymentTransaction $pt)
    {
        if ($pt->status === PaymentTransaction::STATUS_SUCCESS) {
            $cost = number_format($pt->amount, 2);
            Notification::send(auth()->user(), new PaymentNotification("Your Payment for '$pt->description' amounting to $cost was successful. Ref: $pt->ref_no.", '#'));
        }
    }
}
