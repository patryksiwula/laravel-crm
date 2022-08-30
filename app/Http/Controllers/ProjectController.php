<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $projects = Project::with(['user', 'client'])->paginate(15);

		return view('projects.list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * @param  \App\Http\Requests\ProjectRequest  $request
	 * @param  \App\Services\ProjectService $projectService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectRequest $request, ProjectService $projectService): RedirectResponse
    {
        $this->authorize('create-projects');
		$projectService->createProject($request->validated());

		return redirect()->route('projects.index')
			->with('action', 'project_created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
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
			->with('action', 'project_deleted');
    }
}
