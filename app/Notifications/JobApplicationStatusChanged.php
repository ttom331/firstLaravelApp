<?php

namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobApplicationStatusChanged extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected $application;
    protected $job;

    public function __construct(array $application, Job $job)
    {
        $this->application = $application;
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->greeting("\"{$this->job->title}\" Application")
        ->line("The status of your application for the job of \"{$this->job->title}\" at {$this->job->employer->name} has changed to `{$this->application['status']}`.");
            //->action('Notification Action', url('/'))
            
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
