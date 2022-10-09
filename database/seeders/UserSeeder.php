<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create();

        echo "\033[26m"."Dados para autenticação do usuário \n";
        echo "\033[32m".'Email: '.$user->email."\n";
        echo "\033[32m".'Senha: '.'password'."\n";
    }
}
