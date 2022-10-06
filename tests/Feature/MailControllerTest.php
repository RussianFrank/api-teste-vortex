<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MailControllerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_name_type_is_sent_to_schedule_method()
    {
        $response = $this->post('/api/agendar', [
            'nome' => 0,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('nome');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_name_is_not_sent_to_schedule_method()
    {
        $response = $this->post('/api/agendar', [
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('nome');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_email_type_is_sent_to_schedule_method()
    {
        $response = $this->post('/api/agendar', [
            'nome' => $this->faker->name,
            'email' => 'emailerrado.com',
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('email');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_email_is_not_sent_to_schedule_method()
    {
        $response = $this->post('/api/agendar', [
            'nome' => $this->faker->name,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('email');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_assunto_type_is_sent_to_schedule_method()
    {
        $response = $this->post('/api/agendar', [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => 0,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('assunto');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_assunto_is_not_sent_to_schedule_method()
    {
        $response = $this->post('/api/agendar', [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('assunto');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_corpo_email_type_is_sent_to_schedule_method()
    {
        $response = $this->post('/api/agendar', [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => 0,
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('corpo_email');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_corpo_email_is_not_sent_to_schedule_method()
    {
        $response = $this->post('/api/agendar', [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('corpo_email');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_wrong_agendar_type_is_sent_to_schedule_method()
    {
        $response = $this->post('/api/agendar', [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => 'data inválida',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('agendar');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_when_is_sent_to_schedule_method_with_valid_types()
    {
        $this->markTestIncomplete('falta finalizar controlador');

        $response = $this->post('/api/agendar', [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'assunto' => $this->faker->sentence,
            'corpo_email' => $this->faker->text(200),
            'agendar' => $this->faker->date('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(200);
    }
}
