<?php

use App\Http\Controllers\Client\OrganizationController;
use App\Http\Controllers\Client\PersonController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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
	
    Route::resource('users', UserController::class);
	Route::resource('roles', RoleController::class)->except('show');
	Route::resource('permissions', PermissionController::class)->except('show');
	Route::resource('organizations', OrganizationController::class)->except('show');
	Route::resource('people', PersonController::class)->except('show');
});

require __DIR__ . '/auth.php';
