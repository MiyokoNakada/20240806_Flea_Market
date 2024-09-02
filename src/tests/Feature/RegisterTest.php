<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class RegisterTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function user_can_register_and_verify_email()
    {
        Notification::fake();

        $this->startSession();
        $csrfToken = csrf_token();

        $response = $this->post('/register', [
            'email' => 'example@email.com',
            'password' => 'example_pass',
            '_token' => $csrfToken,
        ]);

        $response->assertRedirect('/thanks');

        $user = User::where('email', 'example@email.com')->first();
        $this->assertNotNull($user);
        $this->assertFalse($user->hasVerifiedEmail());

        Notification::assertSentTo(
            [$user],
            VerifyEmail::class
        );

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email), 
            ]
        );
        $response = $this->get($verificationUrl);

        $response->assertRedirect('/?verified=1');

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }
}
