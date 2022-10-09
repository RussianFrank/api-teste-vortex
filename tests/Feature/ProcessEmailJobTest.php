<?php

namespace Tests\Feature;

use App\Mail\BaseEmail;
use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ProcessEmailJobTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_sent_email_with_job_and_verify_database()
    {
        Mail::fake();

        $email = Email::factory()->create([
            'schedule' => null,
        ]);

        Mail::assertSent(BaseEmail::class);

        Mail::assertSent(function (BaseEmail $emailSent) use ($email) {
            return $emailSent->email->email === $email->email
                && $emailSent->email->user_id === $email->user_id
                && $emailSent->email->name === $email->name
                && $emailSent->email->subject === $email->subject
                && $emailSent->email->body === $email->body
                && $emailSent->email->schedule == $email->schedule;
        });

        $this->assertDatabaseHas('emails', [
            'id' => $email->id,
            'is_sent' => 1,
        ]);
    }
}
