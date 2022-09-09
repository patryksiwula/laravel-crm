<div class="relative w-full h-full" style="min-height: 30rem;">
    <div class="w-full flex items-center justify-between mb-6">
        <p class="text-gray-800 dark:text-white text-xl font-medium">
            {{ __('My projects') }}
        </p>
    </div>
	@forelse ($projects as $project)
		<div class="flex items-center mb-2 rounded justify-between p-4 bg-yellow-100">
        	<a href="{{ route('projects.edit', compact('project')) }}" class="flex w-full ml-2 items-center">
				<p class="flex">
					<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" class="inline-flex fill-gray-600">
						<g>
							<rect fill="none" height="24" width="24"/>
							<path d="M20,6h-8l-1.41-1.41C10.21,4.21,9.7,4,9.17,4H4C2.9,4,2.01,4.9,2.01,6L2,18c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V8 C22,6.9,21.1,6,20,6z M14,16H6v-2h8V16z M18,12H6v-2h12V12z"/>
						</g>
					</svg>
					<span class="ml-2 text-gray-600 leading-6">
						{{ $project->name }}
					</span>
				</p>
			</a>
		</div>
	@empty
		{{ __('No projects assigned.') }}
	@endforelse

	@if(!empty($projects))
		<div class="flex absolute bottom-0 mt-6 text-sm">
			<a href="{{ route('projects.index') }}?user_id={{ Auth::user()->id }}">
				{{ __('All projects') }}... &rArr;
			</a>
		</div>
	@endif
</div>
