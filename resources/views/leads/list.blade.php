@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Leads') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-leads')
				<div class="mb-6">
					<a href="{{ route('leads.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Add lead') }} +
					</a>
				</div>
			@endcan
			
            <div class="w-full bg-white">
                <div class="text-gray-900 bg-gray-200">
                    <div class="flex justify-center">
                        <table class="w-full text-md bg-white shadow-md rounded mb-4">
                            <tbody>
                                <tr class="border-b">
									<th>{{ __('No.') }}</th>
									<th class="text-left p-3 px-5">{{ __('Lead title') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Source') }}</th>
									<th class="text-left p-3 px-5">{{ __('Stage') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Lead value') }}</th>
									<th class="text-left p-3 px-5">{{ __('Sales owner') }}</th>
									<th class="text-left p-3 px-5">{{ __('Contact') }}</th>

									@canany(['edit-leads', 'delete-leads'])
										<th class="text-center p-3 px-5">{{ __('Action') }}</th>
									@endcanany
                                </tr>
                                
                                @foreach ($leads as $key => $lead)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
										<td class="p-3 px-5">{{ $key + 1 }} </td>
                                        <td class="p-3 px-5">{{ $lead->name }}</td>
										<td class="p-3 px-5">{{ $lead->source }}</td>
										<td class="p-3 px-5">{{ $lead->stage }}</td>
										<td class="p-3 px-5">{{ $lead->lead_value }}</td>

										<td class="p-3 px-5">
											@can('edit-users')
												<a href="{{ route('users.edit', ['user' => $invoice->user]) }}">{{ $invoice->user->name }}</a>
											@else
												{{ $invoice->user->name }}
											@endcan
										</td>

										<td class="p-3 px-5">
											@can('edit-clients')
												@switch($lead->client::class)
													@case('App\Models\Client\Organization')
														<a href="{{ route('organizations.edit', ['organization' => $lead->client]) }}">
															{{ $lead->client->name }}
														</a>
														@break
													
													@case('App\Models\Client\Person')
														<a href="{{ route('people.edit', ['person' => $lead->client]) }}">
															{{ $lead->client->name }}
														</a>
														@break
												@endswitch
											@else
												{{ $lead->client->name }}
											@endcan
										</td>

										@canany(['edit-leads', 'delete-leads'])
											<td class="p-3 px-5 flex">
												@can('edit-leads')
													<a href="{{ route('leads.edit', compact('lead')) }}" class="text-sm bg-blue-500 hover:bg-blue-700 
														text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Edit') }}
													</a>
												@endcan
												
												@can('delete-leads')
													<form action="{{ route('leads.destroy', compact('lead')) }}" method="POST">
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
					{{ $leads->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection