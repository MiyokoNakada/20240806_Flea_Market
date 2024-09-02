<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function user_can_logout()
    {
        $user = User::first();
        
        $this->actingAs($user);

        $response = $this->post('/logout', [
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
