@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Create new task') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('tasks.update', compact('task')) }}" method="POST">
                    @csrf
					@method('PATCH')

                    <div class="block">
                        <label for="name" class="font-bold text-base text-black block mb-3">
                            {{ __('Name') }}
                        </label>
                        <input type="text" placeholder="{{ __('Task name') }}" name="name" value="{{ $task->name }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

                    <div class="mt-8">
                        <label for="description" class="font-bold text-base text-black block mb-3">
                            {{ __('Description') }}
                        </label>
                        <textarea placeholder="{{ __('Task description') }}" name="description" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">{{ $task->description }}</textarea>
                    </div>

					<div class="mt-8">
                        <label for="user_id" class="font-bold text-base text-black block mb-3">
                            {{ __('Assigned to') }}
                        </label>
                        <select name="user_id" placeholder="{{ __('Task owner') }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
							<option>{{ __('Select task owner') }}</option>

							@foreach ($users as $user)
								<option value="{{ $user->id }}" @selected($user->id == $task->project->user->id)>{{ $user->name }}</option>
							@endforeach
						</select>
                    </div>

					<div class="mt-8 grid grid-cols-2 gap-x-2">
						<livewire:search-model :namespace="'App\Models\\'" :modelPassed="'Project'" :model_id="$task->project->id" :modelSearch="$task->project->name" />
					</div>

					<div class="mt-8">
						<label for="status" class="font-bold text-base text-black block mb-3">
							{{ __('Task status') }}
						</label>
						<select name="status" placeholder="{{ __('Task status') }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
							<option value="pending" @selected($task->status === 'pending')>{{ __('Pending') }}</option>
							<option value="in progress" @selected($task->status === 'in progress')>{{ __('In progress') }}</option>
							<option value="done" @selected($task->status === 'done')>{{ __('Done') }}</option>
						</select>
					</div>

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    	focus:outline-none focus:shadow-outline font-bold cursor-pointer">
                </form>
            </div>
        </div>
    </main>
@endsection