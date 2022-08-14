<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $users = User::with('roles')->get();

        return view('users.list', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
		$this->authorize('create-users');
        $roles = Role::all();

        return view('users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request, UserService $userService): RedirectResponse
    {
		$this->authorize('create-users');

        $user = $userService->createUser(
			$request->name,
			$request->email,
			$request->password,
			$request->roles
		);

		return redirect()->route('users.index')
			->with('action', 'user_created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(User $user): View
    {
		$this->authorize('edit-users');
        $roles = Role::all();

		return view('users.edit', [
			'user' => $user,
			'roles' => $roles
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user, UserService $userService)
    {
		$this->authorize('edit-users');

        $userService->updateUser(
			$user,
			$request->name,
			$request->email,
			$request->roles
		);

		return redirect()->route('users.index')
			->with('action', 'user_updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
		$this->authorize('delete-users');

        $user->delete();

		return redirect()->route('users.list')
			->with('action', 'user_deleted');
    }
}
