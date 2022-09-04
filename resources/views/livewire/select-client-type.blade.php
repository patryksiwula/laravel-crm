<div>
	<label for="client_type" class="font-bold text-base text-black block mb-3">{{ __('Client type') }}</label>

	<select name="client_type" id="client_type" wire:model="clientType" wire:change="setClientType" class="w-full border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium
	text-body-color outline-none focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default
	appearance-none">
		@foreach ($clientTypes as $type)
			<option value="{{ substr($type, 18) }}">{{ substr($type, 18) }}</option>
		@endforeach
	</select>
</div>
