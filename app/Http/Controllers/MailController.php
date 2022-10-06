<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;

class MailController extends Controller
{
    public function schedule(ScheduleRequest $request)
    {
        return response()->json();
    }
}
