<?php

namespace App\Jobs;

use App\Mail\BaseEmail;
use App\Models\Email;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Email $email;

    /**
     * Create a new job instance.
     *
     * @param  Email  $email
     * @return void
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->email->email)->send(new BaseEmail($this->email));
            $this->email->is_sent = true;
            $this->email->save();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
