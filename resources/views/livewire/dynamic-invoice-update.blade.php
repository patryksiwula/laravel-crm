<form wire:submit.prevent="save" class="mt-3">
	@csrf

	<div class="block">
		<label for="invoice_number" class="font-bold text-base text-black block mb-3">
			{{ __('Invoice no.') }}
		</label>
		<input type="text" wire:model="invoiceNumber" placeholder="{{ __('Invoice no.') }}" name="invoice_number" disabled class="w-full border-[1.5px] border-form-stroke
			rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
			active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
	</div>

	<div class="mt-8">
		<label for="invoice_date" class="font-bold text-base text-black block mb-3">
			{{ __('Invoice date') }}
		</label>
		<input type="date" wire:model="invoice_date" name="invoice_date" disabled class="w-full border-[1.5px] border-form-stroke
			rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
			active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
	</div>

	<div class="mt-8">
		<label for="sale_date" class="font-bold text-base text-black block mb-3">
			{{ __('Sale date') }}
		</label>
		<input type="date" wire:model="sale_date" name="sale_date" disabled class="w-full border-[1.5px] border-form-stroke
			rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
			active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
	</div>

	<div class="mt-8">
		<label for="due_date" class="font-bold text-base text-black block mb-3">
			{{ __('Due date') }}
		</label>
		<input type="date" wire:model="due_date" name="due_date" disabled class="w-full border-[1.5px] border-form-stroke
			rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
			active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
	</div>

	<div class="mt-8">
		<label for="payment_method" class="font-bold text-base text-black block mb-3">
			{{ __('Payment method') }}
		</label>
		<select name="payment_method" wire:model="payment_method" class="w-full border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium
		text-body-color outline-none focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default
		appearance-none">
			<option value="cash">Cash</option>
			<option value="bank transfer">Bank transfer</option>
			<option value="credit card">Credit card</option>
		</select>
	</div>

	<div class="mt-8 grid grid-cols-2">
		<div class="pr-2">
			<label for="client_type" class="font-bold text-base text-black block mb-3">
				{{ __('Client') }}
			</label>
			<select name="client_type" wire:model="client_type" class="w-full border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium
			text-body-color outline-none focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default
			appearance-none">
				<option value="Organization">{{ __('Organisation') }}</option>
				<option value="Person">{{ __('Person') }}</option>
			</select>
		</div>
		<div class="pl-2">
			<label for="client_id" class="font-bold text-base text-black block mb-3">
				{{ __('Name') }}
			</label>
			<select name="client_id" wire:model="client_id" class="w-full border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium
			text-body-color outline-none focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default
			appearance-none">
				@foreach ($clients as $client)
					<option value="{{ $client->id }}" @selected($client->id === $client_id)>{{ $client->name }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="mt-16">
		<h2 class="text-2xl font-semibold">{{ __('Products') }}</h2>
		
		<div class="w-full mt-3">
			@if (!$inputs->isEmpty())
				<table class="table w-full p-4 mb-4 bg-gray-100 shadow-md rounded-lg">
					<thead>
						<tr>
							<th class="border p-4 border-gray-300 whitespace-nowrap font-normal text-gray-900">{{ __('Product') }}</th>
							<th class="border p-4 border-gray-300 whitespace-nowrap font-normal text-gray-900">{{ __('Quantity') }}</th>
							<th class="border p-4 border-gray-300 whitespace-nowrap font-normal text-gray-900"></th>
						</tr>
					</thead>
					
					<tbody>
						@foreach ($inputs as $key => $input)
							<tr>
								<td class="w-1/2 border p-4 border-gray-300">
									<select wire:model="invoiceItems.{{ $key }}.product_id" name="invoiceItems.{{ $key }}.product_id" class="w-full border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium text-body-color
									outline-none focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD]
									disabled:cursor-default appearance-none">
										<option>{{ __('Select a product') }}</option>
										
										@foreach ($productsAvailable as $product)
											<option value="{{ $product->id }}">
												{{ $product->name }}
											</option>
										@endforeach
									</select>
								</td>
								<td class="w-1/2 border p-4 border-gray-300">
									<input type="number" min="1" id="invoiceItems.{{ $key }}.quantity" name="invoiceItems.{{ $key }}.quantity" wire:model="invoiceItems.{{ $key }}.quantity" class="w-full border-[1.5px] border-form-stroke
									rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
									active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
								</td>
								<td class="border p-4 border-gray-300">
									<button type="button" wire:click="removeInput({{ $key }})" class="py-2 px-4 bg-red-500 hover:bg-red-700 focus:ring-red-500 
										focus:ring-offset-red-500 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md 
										focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
										{{ __('Remove') }}
									</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
			
			<button type="button" wire:click="addInput" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-500 text-white 
				transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg ">
				{{ __('Add product') }}
			</button>
		</div>
	</div>

	<button type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 focus:ring-green-500 focus:ring-offset-green-500 
		text-white py-2 px-6 rounded focus:outline-none shadow-md focus:ring-2 focus:ring-offset-2 font-bold cursor-pointer 
		transition ease-in duration-200">
		{{ __('Update') }}
	</button>
</form>