<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Lead;
use App\Services\LeadService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
		if ($request->stage === null)
        	$leads = Lead::with(['user', 'client'])->paginate(15);
		else
		{
			$leads = Lead::with(['user', 'client'])->where('stage', '=', $request->stage)
				->paginate(15);
		}
		
		return view('leads.list', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $this->authorize('create-leads');

		return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLeadRequest  $request
	 * @param  \App\Services\LeadService  $leadService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreLeadRequest $request, LeadService $leadService): RedirectResponse
    {
        $this->authorize('create-leads');
		$leadService->createLead($request->validated());

		return redirect()->route('leads.index')
			->with('action', __('actions.lead_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Lead $lead): View
    {
        $this->authorize('edit-leads');

		return view('leads.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLeadRequest  $request
     * @param  \App\Models\Lead  $lead
	 * @param  \App\Services\LeadService  $leadService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateLeadRequest $request, Lead $lead, LeadService $leadService): RedirectResponse
    {
        $this->authorize('edit-leads');
		$leadService->updateLead($lead, $request->validated());

		return redirect()->route('leads.index')
			->with('action', __('actions.lead_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $this->authorize('delete-leads');
		$lead->delete();

		return redirect()->route('leads.index')
			->with('action', __('actions.lead_deleted'));
    }
}
