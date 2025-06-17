<?php

namespace App\Notifications;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationReceived extends Notification
{
    use Queueable;

    protected $application;

    public function __construct(JobApplication $application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nova Candidatura Recebida')
            ->line('Uma nova candidatura foi submetida para a vaga: ' . $this->application->job->title)
            ->line('Candidato: ' . $this->application->name)
            ->action('Ver Candidatura', url('/dashboard/applications/' . $this->application->id))
            ->line('Obrigado por usar o EPATV Job Portal!');
    }
}
