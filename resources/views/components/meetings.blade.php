<div class="relative w-full h-full" style="min-height: 30rem;">
    <div class="w-full flex items-center justify-between mb-6">
        <p class="text-gray-800 dark:text-white text-xl font-medium">
            {{ __('Incoming meetings') }}
        </p>
    </div>
	@forelse ($meetings as $meeting)
		<div class="flex items-center mb-2 rounded justify-between p-4 bg-yellow-100">
        	<a href="{{ route('meetings.edit', compact('meeting')) }}" class="flex w-full ml-2 items-center justify-between">
				<p class="flex">
					<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" class="inline-flex
						fill-gray-600">
						<g>
							<rect fill="none" height="24" width="24"/>
							<rect fill="none" height="24" width="24"/>
						</g>
						<g>
							<path d="M17,2c-0.55,0-1,0.45-1,1v1H8V3c0-0.55-0.45-1-1-1S6,2.45,6,3v1H5C3.89,4,3.01,4.9,3.01,6L3,20c0,1.1,0.89,2,2,2h14 c1.1,0,2-0.9,2-2V6c0-1.1-0.9-2-2-2h-1V3C18,2.45,17.55,2,17,2z M19,20H5V10h14V20z M11,13c0-0.55,0.45-1,1-1s1,0.45,1,1 s-0.45,1-1,1S11,13.55,11,13z M7,13c0-0.55,0.45-1,1-1s1,0.45,1,1s-0.45,1-1,1S7,13.55,7,13z M15,13c0-0.55,0.45-1,1-1s1,0.45,1,1 s-0.45,1-1,1S15,13.55,15,13z M11,17c0-0.55,0.45-1,1-1s1,0.45,1,1s-0.45,1-1,1S11,17.55,11,17z M7,17c0-0.55,0.45-1,1-1 s1,0.45,1,1s-0.45,1-1,1S7,17.55,7,17z M15,17c0-0.55,0.45-1,1-1s1,0.45,1,1s-0.45,1-1,1S15,17.55,15,17z"/>
						</g>
					</svg>
					<span class="ml-2 text-gray-600 leading-6">
						{{ $meeting->description }}
					</span>
				</p>
				<p class="text-gray-600">{{ $meeting->time->format('d.m.Y, H:i') }}</p>
			</a>
		</div>
	@empty
		{{ __('No incoming meetings') }}
	@endforelse

	@if(!empty($meetings))
		<div class="flex absolute bottom-0 mt-6 text-sm">
			<a href="{{ route('meetings.index') }}?user_id={{ Auth::user()->id }}">
				{{ __('All meetings') }}... &rArr;
			</a>
		</div>
	@endif
</div>
