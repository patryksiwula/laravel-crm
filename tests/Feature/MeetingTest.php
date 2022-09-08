<?php

namespace Tests\Feature;

use App\Models\Client\Person;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MeetingTest extends TestCase
{
    /**
	 * @var \Illuminate\Contracts\Auth\Authenticatable
	 */
	private static ?User $admin = null;


	public function setUp(): void
	{
		parent::setUp();

		if (is_null(self::$admin))
		{
			$permissions = [
				Permission::findOrCreate('create-meetings'),
				Permission::findOrCreate('edit-meetings'),
				Permission::findOrCreate('delete-meetings')
			];

			$roleAdmin = Role::findOrCreate('admin');
			$roleAdmin->syncPermissions($permissions);
			self::$admin = User::factory()->create();
			self::$admin->assignRole($roleAdmin);
		}
	}

    public function testAdminCanDisplayCreateMeetingForm(): void
    {
		$this->actingAs(self::$admin);
        $response = $this->get(route('meetings.create'));
        $response->assertOk();
    }

	public function testAdminCanCreateMeeting(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		$client = Person::factory()->create();

		$response = $this->post(route('meetings.store', [
			'description' => 'test',
			'time' => '21.10.2021 20:15',
			'search[0][model_id]' => $user->id,
			'search[1][model_id]' => $client->id,
			'search[1][model_type]' => 'App\Models\Client\Person'
		]));

		$response->assertRedirect(route('meetings.index'));
	}

	public function testAdminCanUpdateMeeting(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		$client = Person::factory()->create();
		$meeting = Meeting::factory()->create();

		$response = $this->from(route('meetings.index'))
			->patch(route('meetings.update', ['meeting' => $meeting]), [
				'description' => 'testt',
				'time' => '2022-10-21',
				'search[0][model_id]' => $user->id,
				'search[1][model_id]' => $client->id,
				'search[1][model_type]' => 'App\Models\Client\Person'
			]
		);

		$response->assertRedirect(route('meetings.index'));
	}

	public function testAdminCanDeleteMeetings(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		$client = Person::factory()->create();
		$meeting = Meeting::factory()->create();

		$response = $this->delete(route('meetings.destroy', ['meeting' => $meeting]));

		$response->assertRedirect(route('meetings.index'));
	}
}
