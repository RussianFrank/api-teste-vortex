<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MailControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('nome');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);
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

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('nome');

        $this->assertDatabaseMissing('emails', [
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);
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

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('email');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);
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

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('email');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);
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

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('assunto');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);
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

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('assunto');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);
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

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('corpo_email');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);
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

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('corpo_email');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'schedule' => $payload['agendar'],
        ]);
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

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('agendar');

        $this->assertDatabaseMissing('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_when_is_sent_to_schedule_method()
    {
        $payload = [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ];

        $response = $this->post('/api/agendar', $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('emails', [
            'name' => $payload['nome'],
            'email' => $payload['email'],
            'subject' => $payload['assunto'],
            'body' => $payload['corpo_email'],
            'schedule' => $payload['agendar'],
        ]);
    }
}
