@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Create new project') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf

                    <div class="block">
                        <label for="name" class="font-bold text-base text-black block mb-3">
                            {{ __('Name') }}
                        </label>
                        <input type="text" placeholder="{{ __('Project name') }}" name="name" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

                    <div class="mt-8">
                        <label for="description" class="font-bold text-base text-black block mb-3">
                            {{ __('Description') }}
                        </label>
                        <textarea placeholder="{{ __('Project description') }}" name="description" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default"></textarea>
                    </div>

					<div class="mt-8">
                        <label for="deadline" class="font-bold text-base text-black block mb-3">
                            {{ __('Deadline') }}
                        </label>
                        <input type="date" name="deadline" placeholder="{{ __('Project deadline') }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					<div class="mt-8">
                        <label for="user_id" class="font-bold text-base text-black block mb-3">
                            {{ __('Owner') }}
                        </label>
                        <select name="user_id" placeholder="{{ __('Project owner') }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
							<option>{{ __('Select project owner') }}</option>

							@foreach ($users as $user)
								<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
                    </div>

					<div class="mt-8 grid grid-cols-2 gap-x-2">
						<livewire:select-client-type :clientTypes="[\App\Models\Client\Organization::class, \App\Models\Client\Person::class]" />
						<livewire:search-model :namespace="'\\App\Models\Client\\'" />
					</div>

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    focus:outline-none focus:shadow-outline font-bold cursor-pointer">

					@if ($errors->any())
						{!! implode('', $errors->all('<div>:message</div>')) !!}
					@endif
                </form>
            </div>
        </div>
    </main>
@endsection