<?php
declare(strict_types=1);

namespace App\Providers;

use App\Events\PublishProcessor;
use App\Listeners\MessageSubscriber;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ReviewRegistered::class => [
            ReviewIndexCreator::class,           // listenプロパティで指定
        ],
        // 会員登録イベントのリスナーを発行（追加）
        'Illuminate\Auth\Events\Registered' => [
            'App\Listeners\RegisteredListener',
        ],
    /*:Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    */
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
