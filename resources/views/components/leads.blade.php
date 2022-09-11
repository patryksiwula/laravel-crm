<div class="relative w-full h-full" style="min-height: 30rem;">
    <div class="w-full flex items-center justify-between mb-6">
        <p class="text-gray-800 dark:text-white text-xl font-medium">
            {{ __('My leads') }}
        </p>
    </div>
	@forelse ($leads as $lead)
		<div class="flex items-center mb-2 rounded justify-between p-4 bg-yellow-100">
        	<a href="{{ route('leads.edit', compact('lead')) }}" class="flex w-full ml-2 items-center">
				<p class="flex">
					<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" class="inline-flex
					fill-gray-600">
						<g>
							<path d="M0,0h24 M24,24H0" fill="none"/>
							<path d="M4.25,5.61C6.57,8.59,10,13,10,13v5c0,1.1,0.9,2,2,2h0c1.1,0,2-0.9,2-2v-5c0,0,3.43-4.41,5.75-7.39 C20.26,4.95,19.79,4,18.95,4H5.04C4.21,4,3.74,4.95,4.25,5.61z"/>
							<path d="M0,0h24v24H0V0z" fill="none"/>
						</g>
					</svg>
					<span class="ml-2 text-gray-600 leading-6">
						{{ $lead->name }}
					</span>
				</p>
			</a>
		</div>
	@empty
		{{ __('No leads assigned') }}
	@endforelse

	@if(!empty($leads))
		<div class="flex absolute bottom-0 mt-6 text-sm">
			<a href="{{ route('leads.index') }}?user_id={{ Auth::user()->id }}">
				{{ __('All leads') }}... &rArr;
			</a>
		</div>
	@endif
</div>
