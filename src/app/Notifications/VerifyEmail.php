<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\App;


class VerifyEmail extends Notification
{
    use Queueable;

    public static $toMailCallback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return (new MailMessage)
             ->subject(Lang::get('メールアドレス認証のお願い'))
             ->greeting('以下の認証リンクをクリックしてください。')
             ->action('ログインして本登録を完了する', $verificationUrl)
             ->line('※「ログインして本登録を完了する」ボタンをがクリックできない場合は以下のURLをコピーしてブラウザに貼り付けてください。')
             ->line($verificationUrl)
             ->line('※こちらのメールは送信専用のメールアドレスより送信しています。恐れ入りますが、直接返信しないようお願いします。');
            // ->view('emails.verify-email', ['url' => $this->verificationUrl($notifiable), 'user' => $notifiable]);
    }


    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'type' => $this->type,
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),

            ]
        );
    }

    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

// class BareMail extends Mailable {
// 	use Queueable, SerializesModels;
// 	public function build() {}
// }