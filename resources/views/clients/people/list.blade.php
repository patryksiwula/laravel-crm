@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('People') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-clients')
				<div class="mb-6">
					<a href="{{ route('people.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Add person') }} +
					</a>
				</div>
			@endcan
			
            <div class="w-full bg-white">
                <div class="text-gray-900 bg-gray-200">
                    <div class="flex justify-center">
                        <table class="w-full text-md bg-white shadow-md rounded mb-4">
                            <tbody>
                                <tr class="border-b">
                                    <th class="text-left p-3 px-5">{{ __('Name') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Email') }}</th>
									<th class="text-left p-3 px-5">{{ __('Phone') }}</th>
									<th class="text-left p-3 px-5">{{ __('Address') }}</th>

									@canany(['edit-clients', 'delete-clients'])
										<th class="text-left p-3 px-5">{{ __('Action') }}</th>
									@endcanany
                                </tr>
                                
                                @foreach ($people as $person)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                        <td class="p-3 px-5">{{ $person->name }}</td>
                                        <td class="p-3 px-5">{{ $person->email }}</td>
                                        <td class="p-3 px-5">{{ $person->phone }}</td>
										<td class="p-3 px-5">{{ $person->address }}</td>

										@canany(['edit-clients', 'delete-clients'])
											<td class="p-3 px-5 flex">
												@can('edit-clients')
													<a href="{{ route('people.edit', ['person' => $person]) }}" class="text-sm bg-blue-500 hover:bg-blue-700 
														text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Edit') }}
													</a>
												@endcan
												
												@can('delete-clients')
													<form action="{{ route('people.destroy', ['person' => $person]) }}" method="POST">
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
					{{ $people->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection