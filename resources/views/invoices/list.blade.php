@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Invoices') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-products')
				<div class="mb-6">
					<a href="{{ route('invoices.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Create invoice') }} +
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
									<th class="text-left p-3 px-5">{{ __('Invoice no.') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Invoice date') }}</th>
									<th class="text-left p-3 px-5">{{ __('Sale date') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Due date') }}</th>
									<th class="text-left p-3 px-5">{{ __('Payment method') }}</th>
									<th class="text-left p-3 px-5">{{ __('Client') }}</th>
									<th class="text-left p-3 px-5">{{ __('Created by') }}</th>
									<th class="text-center p-3 px-5">{{ __('Action') }}</th>
                                </tr>
                                
                                @foreach ($invoices as $key => $invoice)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
										<td class="p-3 px-5">{{ $key + 1 }} </td>
                                        <td class="p-3 px-5">{{ $invoice->invoice_number }}</td>
										<td class="p-3 px-5">{{ $invoice->invoice_date }}</td>
										<td class="p-3 px-5">{{ $invoice->sale_date }}</td>
										<td class="p-3 px-5">{{ $invoice->due_date }}</td>
										<td class="p-3 px-5">{{ $invoice->payment_method }}</td>
										<td class="p-3 px-5">
											@can('edit-clients')
												@switch($invoice->client::class)
													@case('App\Models\Client\Organization')
														<a href="{{ route('organizations.edit', ['organization' => $invoice->client]) }}">
															{{ $invoice->client->name }}
														</a>
														@break
													
													@case('App\Models\Client\Person')
														<a href="{{ route('people.edit', ['person' => $invoice->client]) }}">
															{{ $invoice->client->name }}
														</a>
														@break
												@endswitch
											@else
												{{ $invoice->client->name }}
											@endcan
										</td>
										<td class="p-3 px-5">
											@can('edit-users')
												<a href="{{ route('users.edit', ['user' => $invoice->user]) }}">{{ $invoice->user->name }}</a>
											@else
												{{ $invoice->user->name }}
											@endcan
										</td>

										@canany(['edit-invoices', 'delete-invoices'])
											<td class="p-3 px-5 flex">
												<a href="{{ route('invoices.download', compact('invoice')) }}" class="mr-1 text-sm bg-gray-500 hover:bg-gray-700 
													text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
													{{ __('PDF') }}


												</a>
												<form action="{{ route('invoices.send', compact('invoice')) }}" method="POST">
													@csrf

													<button class="mr-1 text-sm bg-indigo-500 hover:bg-indigo-700 
													text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Send to client') }}
													</button>
												</form>
												@can('edit-invoices')
													<a href="{{ route('invoices.edit', compact('invoice')) }}" class="text-sm bg-blue-500 hover:bg-blue-700 
														text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Edit') }}
													</a>
												@endcan
												
												@can('delete-invoices')
													<form action="{{ route('invoices.destroy', compact('invoice')) }}" method="POST">
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