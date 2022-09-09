<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeetingRequest;
use App\Models\Meeting;
use App\Services\MeetingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
		if ($request->user_id !== null)
		{
        	$meetings = Meeting::with('user', 'client')
				->where('user_id', Auth::user()->id)
				->paginate(15);
		}
		else
			$meetings = Meeting::with('user', 'client')->paginate(15);

		$dateFormat = DB::table('configs')->where('id', 6)->get('value');
		$dateFormat = $dateFormat->get(0)->value;

		return view('meetings.list', compact('meetings', 'dateFormat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $this->authorize('create-meetings');

		return view('meetings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MeetingRequest  $request
	 * @param  \App\Services\MeetingService  $meetingService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MeetingRequest $request, MeetingService $meetingService): RedirectResponse
    {
        $this->authorize('create-meetings');
		$meetingService->createMeeting($request->validated());

		return redirect()->route('meetings.index')
			->with('action', 'meeting_created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Meeting $meeting): View
    {
        $this->authorize('edit-meetings');
		
		return view('meetings.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MeetingRequest  $request
     * @param  \App\Models\Meeting  $meeting
	 * @param  \App\Services\MeetingService  $meetingService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MeetingRequest $request, Meeting $meeting, MeetingService $meetingService): RedirectResponse
    {
        $this->authorize('edit-meetings');
		$meetingService->updateMeeting($meeting, $request->validated());

		return redirect()->route('meetings.index')
			->with('action', 'meeting_updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Meeting $meeting): RedirectResponse
    {
        $this->authorize('delete-meetings');
		$meeting->delete();

		return redirect()->route('meetings.index')
			->with('action', 'meeting_deleted');
    }
}
