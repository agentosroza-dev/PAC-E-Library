<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);
               return (new MailMessage)
            ->subject('សូមផ្ទៀងផ្ទាត់អាសយដ្ឋានអ៊ីមែលរបស់អ្នក')
            ->greeting('សួស្តី ' . $notifiable->name . '!')
            ->line('សូមអរគុណសម្រាប់ការចុះឈ្មោះប្រើប្រាស់សេវាកម្មរបស់យើងខ្ញុំ។')
            ->line('សូមចុចប៊ូតុងខាងក្រោមដើម្បីផ្ទៀងផ្ទាត់អាសយដ្ឋានអ៊ីមែលរបស់អ្នក៖')
            ->action('ផ្ទៀងផ្ទាត់អ៊ីមែល', $verificationUrl)
            ->line('ប្រសិនបើអ្នកមិនបានបង្កើតគណនីនេះទេ សូមមិនត្រូវអើពើនឹងសារនេះឡើយ។')
            ->line('តំណភ្ជាប់នេះនឹងផុតកំណត់ក្នុងរយៈពេល ៦០ នាទី។')
            ->line('ប្រសិនបើអ្នកមានបញ្ហាក្នុងការចុចប៊ូតុង "ផ្ទៀងផ្ទាត់អ៊ីមែល" សូមចម្លង URL ខាងក្រោមទៅកាន់ browser របស់អ្នក៖')
                        // ->line($verificationUrl)
            ->salutation('ដោយក្តីគោរព, ' . config('app.name'));
    }


    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'webv-erify-email',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}


class ApiVerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);
        $frontendUrl = env('APP_EMAIL_VERIFICATION_URL') . '/' . urlencode($verificationUrl);

               return (new MailMessage)
            ->subject('សូមផ្ទៀងផ្ទាត់អាសយដ្ឋានអ៊ីមែលរបស់អ្នក')
            ->greeting('សួស្តី ' . $notifiable->name . '!')
            ->line('សូមអរគុណសម្រាប់ការចុះឈ្មោះប្រើប្រាស់សេវាកម្មរបស់យើងខ្ញុំ។')
            ->line('សូមចុចប៊ូតុងខាងក្រោមដើម្បីផ្ទៀងផ្ទាត់អាសយដ្ឋានអ៊ីមែលរបស់អ្នក៖')
            ->action('ផ្ទៀងផ្ទាត់អ៊ីមែល', $frontendUrl)
            ->line('ប្រសិនបើអ្នកមិនបានបង្កើតគណនីនេះទេ សូមមិនត្រូវអើពើនឹងសារនេះឡើយ។')
            ->line('តំណភ្ជាប់នេះនឹងផុតកំណត់ក្នុងរយៈពេល ៦០ នាទី។')
            ->line('ប្រសិនបើអ្នកមានបញ្ហាក្នុងការចុចប៊ូតុង "ផ្ទៀងផ្ទាត់អ៊ីមែល" សូមចម្លង URL ខាងក្រោមទៅកាន់ browser របស់អ្នក៖')
            // ->line($verificationUrl)
            ->salutation('ដោយក្តីគោរព, ' . config('app.name'));
    }


    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verify.email',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
