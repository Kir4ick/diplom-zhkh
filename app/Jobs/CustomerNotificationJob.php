<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\CustomerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class CustomerNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $idList) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $notificationList = CustomerNotification::query()
            ->with(['address.customers'])
            ->whereIn('id', $this->idList)
            ->get();

        foreach ($notificationList as $notification) {
            /** @var CustomerNotification $notification */
            $customerList = $notification->address->customers;

            foreach ($customerList as $customer) {
                /** @var Customer $customer */
                Mail::html($notification->message, function ($message) use ($customer) {
                    $message->to($customer->email)->subject('Объявление');
                });
            }
        }
    }
}
