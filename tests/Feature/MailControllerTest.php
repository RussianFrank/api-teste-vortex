<?php

namespace Tests\Feature;

use App\Jobs\ProcessEmailJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class MailControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public User $user;
    public string $token;

    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();

        $this->user = User::factory()->create();
        $this->token = JWTAuth::fromUser($this->user);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_name_type_is_sent_to_schedule_method()
    {
        $payload = [
            'nome' => 0,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('nome');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);

        Queue::assertNotPushed(ProcessEmailJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_name_is_not_sent_to_schedule_method()
    {
        $payload = [
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('nome');

        $this->assertDatabaseMissing('emails', [
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);

        Queue::assertNotPushed(ProcessEmailJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_email_type_is_sent_to_schedule_method()
    {
        $payload = [
            'nome' => $this->faker->name,
            'email' => 'emailerrado.com',
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('email');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);

        Queue::assertNotPushed(ProcessEmailJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_email_is_not_sent_to_schedule_method()
    {
        $payload = [
            'nome' => $this->faker->name,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('email');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);

        Queue::assertNotPushed(ProcessEmailJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_assunto_type_is_sent_to_schedule_method()
    {
        $payload = [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => 0,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('assunto');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);

        Queue::assertNotPushed(ProcessEmailJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_assunto_is_not_sent_to_schedule_method()
    {
        $payload = [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('assunto');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);

        Queue::assertNotPushed(ProcessEmailJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_corpo_email_type_is_sent_to_schedule_method()
    {
        $payload = [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => 0,
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('corpo_email');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);

        Queue::assertNotPushed(ProcessEmailJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_corpo_email_is_not_sent_to_schedule_method()
    {
        $payload = [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('corpo_email');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'schedule' => $payload['agendar'],
        ]);

        Queue::assertNotPushed(ProcessEmailJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_agendar_type_is_sent_to_schedule_method()
    {
        $payload = [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => 'data inválida',
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('agendar');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);

        Queue::assertNotPushed(ProcessEmailJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_when_user_is_logged_and_sent_to_schedule_method()
    {
        $payloadSchedule = [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->withToken($this->token)->post(route('v1.email.agendar'), $payloadSchedule);

        $response->assertStatus(200);

        $response->assertExactJson([
            'success' =>  true,
            'data' => 'Email entrou na fila e será disparado em breve!'
        ]);

        $this->assertDatabaseHas('emails', [
            'name' => $payloadSchedule['nome'],
            'user_id' => $this->user->id,
            'email' => $payloadSchedule['email'],
            'subject' => $payloadSchedule['assunto'],
            'body' => $payloadSchedule['corpo_email'],
            'schedule' => $payloadSchedule['agendar'],
        ]);

        Queue::assertPushed(ProcessEmailJob::class);

        Queue::assertPushed(function (ProcessEmailJob $job) use ($payloadSchedule){
            return $job->email->email === $payloadSchedule['email']
                && $job->email->user_id === $this->user->id
                && $job->email->name === $payloadSchedule['nome']
                && $job->email->subject === $payloadSchedule['assunto']
                && $job->email->body === $payloadSchedule['corpo_email']
                && $job->email->schedule === $payloadSchedule['agendar'];
        });

    }
}
