<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\Task;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
	public function getData(): array
	{
		$tasksPending = Task::where('status', 'pending')->get('id')->count();
		$tasksProgress = Task::where('status', 'in progress')->get('id')->count();
		$tasksDone = Task::where('status', 'done')->get('id')->count();

		$projectsPending = Project::where('status', 'pending')->get('id')->count();
		$projectsProgress = Project::where('status', 'in progress')->get('id')->count();
		$projectsDone = Project::where('status', 'done')->get('id')->count();

		$allTasks = (new PieChartModel())->setTitle('Tasks')
			->addSlice('Pending', $tasksPending, '#f6ad55')
			->addSlice('In progress', $tasksProgress, '#fc8181')
			->addSlice('Done', $tasksDone, '#90cdf4');

		$allProjects = (new PieChartModel())->setTitle('Projects')
			->addSlice('Pending', $projectsPending, '#f6ad55')
			->addSlice('In progress', $projectsProgress, '#fc8181')
			->addSlice('Done', $projectsDone, '#90cdf4');

		$userProjects = Project::where('user_id', Auth::user()->id)
			->orderBy('updated_at', 'DESC')
			->take(5)
			->get();

		$userTasks = Task::with('project')
			->where('user_id', Auth::user()->id)
			->orderBy('updated_at', 'DESC')
			->take(5)
			->get();

		$leads = Lead::where('user_id', Auth::user()->id)
			->orderBy('updated_at', 'DESC')
			->take(5)
			->get();

		$meetings = Meeting::where('user_id', Auth::user()->id)
			->where('time', '>', Carbon::now())
			->take(5)
			->get();

		return compact('allTasks', 'allProjects', 'meetings', 'userProjects', 'userTasks', 'leads');
	}
}