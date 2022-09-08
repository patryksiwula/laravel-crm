@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Manage roles') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-roles')
				<div class="mb-6">
					<a href="{{ route('roles.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Create role') }} +
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
                                    <th class="text-left p-3 px-5">{{ __('Permissions') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Action') }}</th>
                                </tr>
                                
                                @foreach ($roles as $role)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                        <td class="p-3 px-5">{{ $role->name }}</td>
                                        <td class="p-3 px-5">
											<div class="max-h-24 overflow-y-auto">
												@forelse ($role->permissions->pluck('name') as $permission)
													{{ $permission }} <br>
												@empty
													{{ '-----' }}
												@endforelse
											</div>
										</td>

										@can('edit-roles')
											<td class="p-3 px-5 flex">
												<a href="{{ route('roles.edit', compact('role')) }}" class="text-sm bg-blue-500 hover:bg-blue-700 
													text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
													{{ __('Edit') }}
												</a>

												<form action="{{ route('roles.destroy', compact('role')) }}" method="POST">
													@csrf
													@method('DELETE')

													<button class="ml-1 text-sm bg-red-500 hover:bg-red-700 text-white 
														py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Delete') }}
													</button>
												</form>
											</td>
										@endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
					{{ $roles->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection