<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Client\Person;
use App\Services\ClientService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $people = Person::paginate(20);

		return view('clients.people.list', [
			'people' => $people
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $this->authorize('create-clients');

		return view('clients.people.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePersonRequest $request, ClientService $clientService): RedirectResponse
    {
        $this->authorize('create-clients');

        $clientService->createPerson(
			$request->validated('name'),
			$request->validated('email'),
			$request->validated('phone'),
			$request->validated('address')
		);

		return redirect()->route('people.index')
			->with('action', 'person_created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person): View
    {
        $this->authorize('edit-clients');

		return view('clients.people.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonRequest  $request
     * @param  \App\Models\Client\Person  $person
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePersonRequest $request, Person $person, ClientService $clientService): RedirectResponse
    {
        $this->authorize('edit-clients');
		$clientService->updatePerson(
			$person,
			$request->validated('name'),
			$request->validated('email'),
			$request->validated('phone'),
			$request->validated('address')
		);

		return redirect()->route('people.index')
			->with('action', 'person_updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client\Person  $person
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Person $person): RedirectResponse
    {
        $this->authorize('delete-clients');
		$person->delete();

		return redirect()->route('people.index')
			->with('action', 'person_deleted');
    }
}
