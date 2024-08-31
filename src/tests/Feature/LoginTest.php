<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Auth\Middleware\Authenticate;
use \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    // 正しいパスワードでログイン試行
    /** @test */
    public function login_with_correct_credentials()
    {
        $this->seed(UsersTableSeeder::class);

        $this->startSession();

        $response = $this->post('/login',
            [
                '_token' => csrf_token(),
                'email' => 'test@email.com',
                'password' => 'test_pass',
            ]
        );

        $response->assertRedirect('/'); 
        $response->assertStatus(302);
    }

    //誤ったパスワードでログイン試行
    /** @test */
    public function login_with_incorrect_credentials()
    {
        $this->seed(UsersTableSeeder::class);

        $this->startSession();

        $response = $this->post(
            '/login',
            [
                '_token' => csrf_token(),
                'email' => 'test@email.com',
                'password' => 'wrong_pass',
            ]
        );

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
