<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Services\MailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MailController extends Controller
{
    protected MailService $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * @param  ScheduleRequest  $request
     * @return JsonResponse
     */
    public function schedule(ScheduleRequest $request): JsonResponse
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

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function historic(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $request->user()->historic()->paginate(10),
        ]);
    }
}
