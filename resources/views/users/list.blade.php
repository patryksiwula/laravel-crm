@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Users') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-users')
				<div class="mb-6">
					<a href="{{ route('users.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Create user') }} +
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
                                    <th class="text-left p-3 px-5">{{ __('Name') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Email') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Roles') }}</th>

									@canany(['update-users', 'delete-users'])
										<th class="text-left p-3 px-5">{{ __('Action') }}</th>
									@endif
                                </tr>
                                
                                @foreach ($users as $user)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                        <td class="p-3 px-5">{{ $user->name }}</td>
                                        <td class="p-3 px-5">{{ $user->email }}</td>
                                        <td class="p-3 px-5">
											@foreach ($user->getRoleNames() as $role)
												{{ $role }} <br>
											@endforeach
										</td>

										@canany(['update-users', 'delete-users'])
											<td class="p-3 px-5 flex">
												@can('edit-users')
													<a href="{{ route('users.edit', ['user' => $user]) }}" class="text-sm bg-blue-500 hover:bg-blue-700 
														text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Edit') }}
													</a>
												@endcan
												
												@can('delete-users')
													@if($user->id !== Auth::id())
														<form action="{{ route('users.destroy', ['user' => $user]) }}" method="POST">
															@csrf
															@method('DELETE')

															<button class="ml-1 text-sm bg-red-500 hover:bg-red-700 text-white 
																py-2 px-4 rounded focus:outline-none focus:shadow-outline">
																{{ __('Delete') }}
															</button>
														</form>
													@endif
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