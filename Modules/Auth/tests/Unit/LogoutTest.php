<?php

namespace Modules\Auth\tests\Unit;

use Modules\Auth\app\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create(['email' => 'user@test.com']);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('get', '/api/v1/products', [], $headers)->assertStatus(200);
        $this->json('post', '/api/v1/logout', [], $headers)->assertStatus(200);
        $user = User::find($user->id);
        $this->assertEquals(null, $user->api_token);
    }
}
