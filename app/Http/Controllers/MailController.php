<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Services\MailService;

class MailController extends Controller
{
    protected MailService $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function schedule(ScheduleRequest $request)
    {
        $createEmail = $this->mailService->create(
            $request->validated()
        );

        return response()->json([
            'success' => $createEmail ? true : false,
            'data' => $createEmail ? 'Email entrou na fila e será disparado em breve!' : 'falha no disparo',
        ]);
    }
}
