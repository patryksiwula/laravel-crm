<?php

use App\Http\Controllers\Client\OrganizationController;
use App\Http\Controllers\Client\PersonController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::redirect('/', 'dashboard');
	
    Route::resource('users', UserController::class)->except('show');
	Route::resource('roles', RoleController::class)->except('show');
	Route::resource('permissions', PermissionController::class)->except('show');
	Route::resource('organizations', OrganizationController::class)->except('show');
	Route::resource('people', PersonController::class)->except('show');

	Route::view('/products/create', 'products.create')->name('products.create');
	Route::resource('products', ProductController::class)->except(['show', 'create']);

	Route::prefix('invoices')->group(function () {
		Route::controller(InvoiceController::class)->group(function () {
			Route::get('/{invoice}/download', 'download')->name('invoices.download');
			Route::post('/{invoice}/send', 'send')->name('invoices.send');
		});

		Route::view('/create', 'invoices.create')->name('invoices.create');
	});

	Route::resource('invoices', InvoiceController::class)->except(['create', 'store']);
	Route::resource('projects', ProjectController::class)->except('show');
	Route::resource('tasks', TaskController::class)->except('show');
	Route::resource('meetings', MeetingController::class)->except('show');

	Route::group(['prefix' => 'configs', 'controller' => ConfigurationController::class], function () {
		Route::get('/', 'index')->name('configs.index');
		Route::get('/edit', 'edit')->name('configs.edit');
		Route::match(['PUT', 'PATCH'], '/', 'update')->name('configs.update');
	});

	Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
	Route::resource('documents', DocumentController::class)->except(['show', 'edit', 'update']);
});

require __DIR__ . '/auth.php';
