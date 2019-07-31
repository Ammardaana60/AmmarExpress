<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\CreateOrder;
use App\Events\CreateAddress;
use App\Events\CreateTransaction;
use App\Listeners\createOrderListener;
use App\Listeners\createAddresslistener;
use App\Listeners\createTransactionListener;
use App\Events\SendSupplierNotification;
use App\Listeners\SendSupplierNotificationListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
       CreateTransaction::class => [
            createTransactionListener::class,
        ],
        CreateOrder::class=>[
            createOrderListener::class,
        ],
        CreateAddress::class=>[
            createAddresslistener::class,
        ],
        SendSupplierNotification::class=>[
            SendSupplierNotificationListener::class,
        ],
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
   
    public function boot()
    {
        
        parent::boot();

       
    }
}
