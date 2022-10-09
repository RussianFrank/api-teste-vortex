<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Services\MailService;
use Illuminate\Http\Request;

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
            $request->validated(),
            $request->user()->id
        );

        return response()->json([
            'success' => $createEmail ? true : false,
            'data' => $createEmail ? 'Email entrou na fila e será disparado em breve!' : 'falha no disparo',
        ]);
    }

    public function historic(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user()->historic,
        ]);
    }
}
