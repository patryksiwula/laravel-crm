@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Products') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-products')
				<div class="mb-6">
					<a href="{{ route('products.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Add product') }} +
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
									<th class="text-left p-3 px-5">{{ __('ID') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Name') }}</th>
									<th class="text-left p-3 px-5">{{ __('Price per unit') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Quantity') }}</th>

									@canany(['edit-products', 'delete-products'])
										<th class="text-left p-3 px-5">{{ __('Action') }}</th>
									@endcanany
                                </tr>
                                
                                @foreach ($products as $product)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                        <td class="p-3 px-5">{{ $product->id }}</td>
										<td class="p-3 px-5">{{ $product->name }}</td>
										<td class="p-3 px-5">{{ number_format($product->price, 2) }}</td>
										<td class="p-3 px-5">{{ $product->quantity }}</td>

										@canany(['edit-products', 'delete-products'])
											<td class="p-3 px-5 flex">
												@can('edit-products')
													<a href="{{ route('products.edit', compact('product')) }}" class="text-sm bg-blue-500 hover:bg-blue-700 
														text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Edit') }}
													</a>
												@endcan
												
												@can('delete-products')
													<form action="{{ route('products.destroy', compact('product')) }}" method="POST">
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
					{{ $products->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection