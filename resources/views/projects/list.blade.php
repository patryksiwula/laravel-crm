@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Projects') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-projects')
				<div class="mb-6">
					<a href="{{ route('projects.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Create project') }}
					</a>
				</div>
			@endcan
			
            <div class="w-full bg-white">
                <div class="text-gray-900 bg-gray-200">
                    <div class="flex justify-center">
                        <table class="w-full text-md bg-white shadow-md rounded mb-4">
                            <tbody>
                                <tr class="border-b">
									<th class="text-left p-3 px-5">{{ __('ID') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Name') }}</th>
									<th class="text-left p-3 px-5">{{ __('Status') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Deadline') }}</th>
									<th class="text-left p-3 px-5">{{ __('Owner') }}</th>
									<th class="text-left p-3 px-5">{{ __('Client') }}</th>

									@canany(['edit-projects', 'delete-projects'])
										<th class="text-left p-3 px-5">{{ __('Action') }}</th>
									@endcanany
                                </tr>
                                
                                @foreach ($projects as $project)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                        <td class="p-3 px-5">{{ $project->id }}</td>
										<td class="p-3 px-5">{{ $project->name }}</td>
										<td class="p-3 px-5">{{ $project->status }}</td>
										<td class="p-3 px-5">{{ $project->deadline }}</td>
										<td class="p-3 px-5">
											@can('edit-users')
												<a href="{{ route('users.edit', ['user' => $project->user_id]) }}">
													{{ \App\Models\User::find($project->user_id)->name }}
												</a>
											@else
												{{ \App\Models\User::find($project->user_id)->name }}
											@endcan
										</td>

										<td class="p-3 px-5">
											@can('edit-clients')
												@if ($project->client_type === 'App\Models\Client\Organization')
													<a href="{{ route('organizations.edit', ['organization' => $project->client_id]) }}">
												@elseif ($project->client_type === 'App\Models\Client\Person')
													<a href="{{ route('people.edit', ['person' => $project->client_id]) }}">
												@endif
														{{ $project->client_type::find($project->client_id)->name }}
													</a>
											@else
												{{ $project->client_type::find($project->client_id)->name }}
											@endcan
										</td>

										@canany(['edit-projects', 'delete-projects'])
											<td class="p-3 px-5 flex">
												@can('edit-projects')
													<a href="{{ route('projects.edit', compact('project')) }}" class="text-sm bg-blue-500 hover:bg-blue-700 
														text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Edit') }}
													</a>
												@endcan
												
												@can('delete-projects')
													<form action="{{ route('projects.destroy', compact('project')) }}" method="POST">
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
                </div>
            </div>
        </div>
    </main>
@endsection