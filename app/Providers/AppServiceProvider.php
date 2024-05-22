<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('[Unicode Academy] Vui lòng kích hoạt tài khoản')
                ->line('Hãy click vào nút bên dưới để kích hoạt tài khoản của bạn')
                ->action('Kích hoạt tài khoản', $url)
                ->line('Nếu bạn chưa tài khoản thì không cần làm gì');
        });
    }
}
