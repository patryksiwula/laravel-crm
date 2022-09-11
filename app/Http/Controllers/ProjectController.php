<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
	 * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
		if ($request->user_id !== null)
			$wheres['user_id'] = $request->user_id;
		
		if ($request->status !== null)
			$wheres['status'] = $request->status;

		$projects = Project::with(['user', 'client'])->where($wheres)
			->paginate(15);

		$dateFormat = DB::table('configs')->where('id', 6)->get('value');
		$dateFormat = $dateFormat->get(0)->value;

		return view('projects.list', compact('projects', 'dateFormat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
		$this->authorize('create-projects');
		$users = User::select(['id', 'name'])->get();

        return view('projects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
	 * @param  \App\Services\ProjectService $projectService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProjectRequest $request, ProjectService $projectService): RedirectResponse
    {
        $this->authorize('create-projects');
		$projectService->createProject($request->validated());

		return redirect()->route('projects.index')
			->with('action', __('actions.project_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Project $project): View
    {
        $this->authorize('edit-projects');
		$users = User::select(['id', 'name'])->get();

		return view('projects.edit', compact('project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProjectRequest $request, Project $project, ProjectService $projectService): RedirectResponse
    {
        $this->authorize('edit-projects');
        $projectService->updateProject($project, $request->validated());

		return redirect()->route('projects.index')
			->with('action', __('actions.project_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->authorize('delete-projects');
		$project->delete();

		return redirect()->route('projects.index')
			->with('action', __('actions.project_deleted'));
    }
}
