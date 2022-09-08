@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Updating project') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('projects.update', compact('project')) }}" method="POST">
                    @csrf
					@method('PATCH')

                    <div class="block">
                        <label for="name" class="font-bold text-base text-black block mb-3">
                            {{ __('Name') }}
                        </label>
                        <input type="text" placeholder="{{ __('Project name') }}" name="name" value="{{ $project->name }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

                    <div class="mt-8">
                        <label for="description" class="font-bold text-base text-black block mb-3">
                            {{ __('Description') }}
                        </label>
                        <textarea placeholder="{{ __('Project description') }}" name="description" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">{{ $project->description }}</textarea>
                    </div>

					<div class="mt-8">
                        <label for="deadline" class="font-bold text-base text-black block mb-3">
                            {{ __('Deadline') }}
                        </label>
                        <input type="date" name="deadline" placeholder="{{ __('Project deadline') }}" value="{{ $project->deadline }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					@php $i = 0; @endphp

					<div class="mt-8">
						<livewire:search-model :modelPassed="'User'" :label="'User'" :model_id="$project->user->id"
							:modelSearch="$project->user->name" :multiple="true" :count="$i++" />
                    </div>

					<div class="mt-8 grid grid-cols-2 gap-x-2">
						<livewire:select-client-type :clientTypes="[\App\Models\Client\Organization::class, \App\Models\Client\Person::class]"
							:clientType="substr($project->client::class, 18)" />
						<livewire:search-client :namespace="'App\Models\Client\\'" :client_type="substr($project->client::class, 18)" :modelName="'Client'"
							:label="'Client'" :model_id="$project->client->id" :modelSearch="$project->client->name" :multiple="true" :count="$i" />
					</div>

					<div class="mt-8">
						<label for="status" class="font-bold text-base text-black block mb-3">
							{{ __('Status') }}
						</label>
						<select name="status" placeholder="{{ __('Project status') }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
							<option value="pending" @selected($project->status === 'pending')>{{ __('Pending') }}</option>
							<option value="in progress" @selected($project->status === 'in progress')>{{ __('In progress') }}</option>
							<option value="done" @selected($project->status === 'done')>{{ __('Done') }}</option>
						</select>
					</div>

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    	focus:outline-none focus:shadow-outline font-bold cursor-pointer">
                </form>
            </div>
        </div>
    </main>
@endsection