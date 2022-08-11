<?php

namespace Tests\Feature;

use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testGuestIsBeingRedirectedToLoginPage(): void
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

	public function testUserIsBeingRedirectedToDashboard(): void
	{
		/**
		 * @var \Illuminate\Contracts\Auth\Authenticatable
		 */
		$user = User::factory()->create();

		$this->actingAs($user);
		$response = $this->get('/');
        $response->assertRedirect('/dashboard');
	}
}
