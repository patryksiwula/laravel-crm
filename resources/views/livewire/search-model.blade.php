<div>
	<label for="modelSearch" class="font-bold text-base text-black block mb-3">{{ 'Client' }}</label>

	<div x-data="{ open: false, selectedModel: @entangle('modelSelected') }" class="relative">
		<input type="text" name="modelSearch" id="model-search" wire:model="modelSearch" class="relative w-full border-[1.5px] border-form-stroke
			rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
			active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default" x-on:focus="open = true" x-on:blur="await new Promise(resolve => setTimeout(resolve, 500)); open = false;">
		<ul	@class(['block',
					'bg-white',
					'shadow-md',
					'w-full',
					'h-60',
					'absolute',
					'overflow-auto'])
			x-show="open">

			@forelse ($models as $key => $selectedModel)
				<li class="px-7 py-5 cursor-pointer hover:bg-green-100" wire:click="setModel({{ $selectedModel->id }})" wire:key="models.{{ $key }}">{{ $selectedModel->name }}</li>
			@empty
				<li class="px-7 py-5">{{ __('No results found') }}</li>
			@endforelse
		</ul>

		<input type="hidden" name="model_id" wire:model="model_id">
		<input type="hidden" name="model_type" wire:model="model_type">
	</div>
</div>