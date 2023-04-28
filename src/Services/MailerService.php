<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;

class MailerService
{
    private $replyTo;
    public function __construct(private MailerInterface $mailer, $replyTo){
        $this->replyTo = $replyTo;
    }
    public function sendEmail($content): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            ->replyTo($this->replyTo)
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('sending')
            ->html($content)
            ->attachPart(new DataPart('hello world'));
            

        $this->mailer->send($email);

        // ...
    }
}
