<?php

use App\Http\Controllers\Client\OrganizationController;
use App\Http\Controllers\Client\PersonController;
use App\Http\Controllers\UserController;
use App\Models\Client\Organization;
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
	
    Route::resource('users', UserController::class);

	Route::view('/organizations/create', 'clients.organizations.create')->name('organizations.create');
	Route::resource('organizations', OrganizationController::class)->except(['create', 'show']);

	Route::view('/people/create', 'clients.people.create')->name('people.create');
	Route::resource('people', PersonController::class)->except(['create', 'show']);
});

require __DIR__ . '/auth.php';
