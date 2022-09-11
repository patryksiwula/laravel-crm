<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Client\Organization;
use App\Services\ClientService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $organizations = Organization::paginate(20);

		return view('clients.organizations.list', compact('organizations'));
    }

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $this->authorize('create-clients');

		return view('clients.organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrganizationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrganizationRequest $request, ClientService $clientService): RedirectResponse
    {
		$this->authorize('create-clients');
        $clientService->createOrganisation($request->validated());

		return redirect()->route('organizations.index')
			->with('action', __('actions.organisation_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Organization $organization): View
    {
        $this->authorize('edit-clients');

		return view('clients.organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrganizationRequest  $request
     * @param  \App\Models\Client\Organization  $organization
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization, ClientService $clientService): RedirectResponse
    {
        $this->authorize('edit-clients');
		$clientService->updateOrganization($organization, $request->validated());

		return redirect()->route('organizations.index')
			->with('action', __('actions.organisation_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client\Organization  $organization
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Organization $organization): RedirectResponse
    {
        $this->authorize('delete-clients');
		$organization->delete();

		return redirect()->route('organizations.index')
			->with('action', __('actions.organisation_deleted'));
    }
}
