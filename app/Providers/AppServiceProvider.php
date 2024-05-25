<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
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
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
            return (new MailMessage)
                ->subject('[Unicode Academy] Yêu cầu đặt lại mật khẩu')
                ->line('Hãy click vào nút bên dưới để đặt lại mật khẩu tài khoản của bạn')
                ->line('Chúng tôi nhận được yêu cầu đặt lại mật khẩu của bạn')
                ->action('Đặt lại mật khẩu', $url)
                ->line('Nếu bạn không gửi yêu cầu thì không cần làm gì cả');
        });
    }
}
