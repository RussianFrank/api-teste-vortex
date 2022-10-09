<?php

namespace App\Services;

use App\Models\Email;

class MailService
{
    public function create(array $emailRequest, int $user_id): Email
    {
        return Email::create([
            'name' => $emailRequest['nome'],
            'user_id' => $user_id,
            'email' => $emailRequest['email'],
            'subject' => $emailRequest['assunto'],
            'body' => $emailRequest['corpo_email'],
            'schedule' => isset($emailRequest['agendar']) ? $emailRequest['agendar'] : now(),
        ]);
    }
}
