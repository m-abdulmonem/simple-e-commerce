<?php

namespace Modules\Auth\tests\Unit;

use Modules\Auth\app\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    public function testLogout()
    {
        // Create a user
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Make a request to the logout action
        $response = $this->post('/logout');

        // Assert the user's tokens have been deleted
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
        ]);

        // Assert a successful logout message is returned
        $response->assertJson([
            'message' => __('Successfully logged out'),
        ]);
    }
}
