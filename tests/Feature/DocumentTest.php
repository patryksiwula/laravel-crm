<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DocumentTest extends TestCase
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
				Permission::findOrCreate('create-documents'),
				Permission::findOrCreate('delete-documents')
			];

			$roleAdmin = Role::findOrCreate('admin');
			$roleAdmin->syncPermissions($permissions);
			self::$admin = User::factory()->create();
			self::$admin->assignRole($roleAdmin);
		}
	}
    
	public function testAdminCanDisplayCreateDocumentForm(): void
    {
		$this->actingAs(self::$admin);
        $response = $this->get(route('documents.create'));
        $response->assertOk();
    }

	public function testAdminCanCreateDocument(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();

		Storage::fake('testdocuments');

		$response = $this->post(route('documents.store', [
			'file_name' => 'test.docx',
			'description' => 'test',
			'user_id' => $user->id
		]), ['file' => UploadedFile::fake()->create('test.docx')]);

		$response->assertRedirect(route('documents.index'));
	}

	public function testAdminCanDeleteDocument(): void
	{
		$this->actingAs(self::$admin);
		$user = User::factory()->create();
		
		$document = Document::create([
			'file_name' => 'test',
			'extension' => '.docx',
			'path' => 'test.docx',
			'description' => 'test',
			'user_id' => $user->id
		]);

		$response = $this->delete(route('documents.destroy', ['document' => $document]));
		$response->assertRedirect(route('documents.index'));
	}
}
