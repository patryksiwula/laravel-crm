@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Tasks') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-projects')
				<div class="mb-6">
					<a href="{{ route('tasks.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Create task') }}
					</a>
				</div>
			@endcan
			
            <div class="w-full bg-white">
                <div class="text-gray-900 bg-gray-200">
                    <div class="flex justify-center">
                        <table class="w-full text-md bg-white shadow-md rounded mb-4">
                            <tbody>
                                <tr class="border-b">
									<th class="text-left p-3 px-5">{{ __('No.') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Name') }}</th>
									<th class="text-left p-3 px-5">{{ __('Status') }}</th>
									<th class="text-left p-3 px-5">{{ __('Assigned to') }}</th>
									<th class="text-left p-3 px-5">{{ __('Project') }}</th>

									@canany(['edit-tasks', 'delete-tasks'])
										<th class="text-left p-3 px-5">{{ __('Action') }}</th>
									@endcanany
                                </tr>
                                
                                @foreach ($tasks as $key => $task)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                        <td class="p-3 px-5">{{ $key + 1 }}</td>
										<td class="p-3 px-5">{{ $task->name }}</td>
										<td class="p-3 px-5">
											<a href="{{ route('tasks.index') }}?status={{ $task->status }}">
												@switch($task->status)
													@case('pending')
														<x-badge :color="'slate'">{{ __(ucfirst($task->status)) }}</x-badge>
														@break
													
													@case('in progress')
														<x-badge :color="'orange'">{{ __(ucfirst($task->status)) }}</x-badge>
														@break
													
													@case('done')
														<x-badge :color="'green'">{{ __(ucfirst($task->status)) }}</x-badge>
														@break;
												@endswitch
											</a>
										</td>
										<td class="p-3 px-5">
											@can('edit-users')
												<a href="{{ route('users.edit', ['user' => $task->user]) }}">
													{{ $task->user->name }}
												</a>
											@else
												{{ $task->user->name }}
											@endcan
										</td>
										<td class="p-3 px-5">
											@can('edit-projects')
												<a href="{{ route('projects.edit', ['project' => $task->project]) }}">
													{{ $task->project->name }}
												</a>
											@else
												{{ $task->project->name }}
											@endcan
										</td>

										@canany(['edit-tasks', 'delete-tasks'])
											<td class="p-3 px-5 flex">
												@can('edit-tasks')
													<a href="{{ route('tasks.edit', compact('task')) }}" class="text-sm bg-blue-500 hover:bg-blue-700 
														text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Edit') }}
													</a>
												@endcan
												
												@can('delete-tasks')
													<form action="{{ route('tasks.destroy', compact('task')) }}" method="POST">
														@csrf
														@method('DELETE')

														<button class="ml-1 text-sm bg-red-500 hover:bg-red-700 text-white 
															py-2 px-4 rounded focus:outline-none focus:shadow-outline">
															{{ __('Delete') }}
														</button>
													</form>
												@endcan
											</td>
										@endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
					{{ $tasks->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection