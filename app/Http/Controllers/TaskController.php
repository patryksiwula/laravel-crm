<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
	 * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): View
    {
		$wheres = [];
		
		if ($request->user_id !== null)
			$wheres['user_id'] = $request->user_id;
		
		if ($request->status !== null)
			$wheres['status'] = $request->status;

		$tasks = Task::with(['user', 'project'])->where($wheres)
			->paginate(15);

		return view('tasks.list', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
		$this->authorize('create-tasks');
        $users = User::select(['id', 'name'])->get();
		
		return view('tasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTaskRequest $request, TaskService $taskService): RedirectResponse
    {
		$this->authorize('create-tasks');
        $taskService->createTask($request->validated());

		return redirect()->route('tasks.index')
			->with('action', __('actions.task_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Task $task): View
    {
		$this->authorize('edit-tasks');
        $users = User::select(['id', 'name'])->get();

		return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTaskRequest $request, Task $task, TaskService $taskService): RedirectResponse
    {
        $this->authorize('edit-tasks');
        $taskService->updateTask($task, $request->validated());

		return redirect()->route('tasks.index')
			->with('action', __('actions.task_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete-tasks');
		$task->delete();

		return redirect()->route('tasks.index')
			->with('action', __('actions.task_deleted'));
    }
}
