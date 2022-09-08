<div>
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
								<select wire:model="items.{{ $key }}.product_id" class="w-full border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium text-body-color
								outline-none focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD]
								disabled:cursor-default appearance-none">
									<option>{{ __('Select a product') }}</option>
									
									@foreach ($productsAvailable as $productAvailable)
										<option value="{{ $productAvailable->id }}">
											{{ $productAvailable->name }}
										</option>
									@endforeach
								</select>
							</td>
							<td class="w-1/2 border p-4 border-gray-300">
								<input type="number" min="1" id="items.{{ $key }}.quantity" wire:model="items.{{ $key }}.quantity" class="w-full border-[1.5px] border-form-stroke
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

						<input type="hidden" name="products[{{ $key }}][product_id]" wire:model="items.{{ $key }}.product_id">
						<input type="hidden" name="products[{{ $key }}][quantity]" wire:model="items.{{ $key }}.quantity">
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
