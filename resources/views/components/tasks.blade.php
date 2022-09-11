<div class="relative w-full h-full" style="min-height: 30rem;">
    <div class="w-full flex items-center justify-between mb-6">
        <p class="text-gray-800 dark:text-white text-xl font-medium">
            {{ __('My tasks') }}
        </p>
    </div>
	@forelse ($tasks as $task)
		<div class="flex items-center mb-2 rounded justify-between p-4 bg-yellow-100">
        	<a href="{{ route('tasks.edit', compact('task')) }}" class="flex w-full ml-2 items-center">
				<p class="flex">
					<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" class="inline-flex fill-gray-600">
						<g>
							<path d="M0,0h24v24H0V0z" fill="none"/>
						</g>
						<g>
							<path d="M19.41,7.41l-4.83-4.83C14.21,2.21,13.7,2,13.17,2H6C4.9,2,4.01,2.9,4.01,4L4,20c0,1.1,0.89,2,1.99,2H18c1.1,0,2-0.9,2-2 V8.83C20,8.3,19.79,7.79,19.41,7.41z M10.23,17.29l-2.12-2.12c-0.39-0.39-0.39-1.02,0-1.41l0,0c0.39-0.39,1.02-0.39,1.41,0 l1.41,1.41l3.54-3.54c0.39-0.39,1.02-0.39,1.41,0l0,0c0.39,0.39,0.39,1.02,0,1.41l-4.24,4.24C11.26,17.68,10.62,17.68,10.23,17.29z M14,9c-0.55,0-1-0.45-1-1V3.5L18.5,9H14z"/>
						</g>
					</svg>
					<span class="ml-2 text-gray-600 leading-6">
						{{ $task->name }}
					</span>
				</p>
			</a>
			<a href="{{ route('projects.edit', ['project' => $task->project]) }}" class="ml-2 text-gray-600 leading-6">
				<p class="flex">
					<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" class="inline-flex fill-gray-600">
						<g>
							<rect fill="none" height="24" width="24"/>
							<path d="M20,6h-8l-1.41-1.41C10.21,4.21,9.7,4,9.17,4H4C2.9,4,2.01,4.9,2.01,6L2,18c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V8 C22,6.9,21.1,6,20,6z M14,16H6v-2h8V16z M18,12H6v-2h12V12z"/>
						</g>
					</svg>

					<span class="ml-2 text-gray-600 leading-6">{{ $task->project->name }}</span>
				</p>
			</a>
		</div>
	@empty
		{{ __('No tasks assigned.') }}
	@endforelse

	@if(!empty($tasks))
		<div class="flex absolute bottom-0 mt-6 text-sm">
			<a href="{{ route('tasks.index') }}?user_id={{ Auth::user()->id }}">
				{{ __('All tasks') }}... &rArr;
			</a>
		</div>
	@endif
</div>
