<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    // 正しいパスワードでログイン試行
    #[\PHPUnit\Framework\Attributes\Test]
    public function login_with_correct_credentials()
    {
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
    #[\PHPUnit\Framework\Attributes\Test]
    public function login_with_incorrect_credentials()
    {
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
