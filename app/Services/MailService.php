<?php

namespace App\Services;

use App\Models\Email;

class MailService
{
    public function create(array $emailRequest): Email
    {
        return Email::create([
            'name' => $emailRequest['nome'],
            'email' => $emailRequest['email'],
            'subject' => $emailRequest['assunto'],
            'body' => $emailRequest['corpo_email'],
            'schedule' => $emailRequest['agendar'],
        ]);
    }
}
