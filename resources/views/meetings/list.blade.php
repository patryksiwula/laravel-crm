@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Meetings') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-meetings')
				<div class="mb-6">
					<a href="{{ route('meetings.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Create meeting') }}
					</a>
				</div>
			@endcan

			@if (Session::has('action'))
				<x-bladewind.notification />

				<script type="text/javascript">
					var title = `{{ __('Success') }}`;
					var message = `{{ Session::get('action') }}`;
					showNotification(title, message);
				</script>
			@endif
			
            <div class="w-full bg-white">
                <div class="text-gray-900 bg-gray-200">
                    <div class="flex justify-center">
                        <table class="w-full text-md bg-white shadow-md rounded mb-4">
                            <tbody>
                                <tr class="border-b">
									<th class="text-left p-3 px-5">{{ __('No.') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Description') }}</th>
									<th class="text-left p-3 px-5">{{ __('Time') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('User') }}</th>
									<th class="text-left p-3 px-5">{{ __('Client') }}</th>

									@canany(['edit-meetings', 'delete-meetings'])
										<th class="text-left p-3 px-5">{{ __('Action') }}</th>
									@endcanany
                                </tr>
                                
                                @foreach ($meetings as $key => $meeting)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                        <td class="p-3 px-5">{{ $key + 1 }}</td>
										<td class="p-3 px-5">{{ $meeting->description }}</td>
										<td class="p-3 px-5">{{ $meeting->time->format($dateFormat . ', H:i') }}</td>
										<td class="p-3 px-5">
											@can('edit-users')
												<a href="{{ route('users.edit', ['user' => $meeting->user]) }}">
													{{ $meeting->user->name }}
												</a>
											@else
												{{ $meeting->user->name }}
											@endcan
										</td>

										<td class="p-3 px-5">
											@can('edit-clients')
												@if ($meeting->client::class === 'App\Models\Client\Organization')
													<a href="{{ route('organizations.edit', ['organization' => $meeting->client]) }}">
												@elseif ($meeting->client::class === 'App\Models\Client\Person')
													<a href="{{ route('people.edit', ['person' => $meeting->client]) }}">
												@endif
														{{ $meeting->client->name }}
													</a>
											@else
												{{ $meeting->client->name }}
											@endcan
										</td>

										@canany(['edit-meetings', 'delete-meetings'])
											<td class="p-3 px-5 flex">
												@can('edit-meetings')
													<a href="{{ route('meetings.edit', compact('meeting')) }}" class="text-sm bg-blue-500 hover:bg-blue-700 
														text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Edit') }}
													</a>
												@endcan
												
												@can('delete-meetings')
													<form action="{{ route('meetings.destroy', compact('meeting')) }}" method="POST">
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
					{{ $meetings->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection