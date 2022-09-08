@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Create new meeting') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('meetings.update', compact('meeting')) }}" method="POST">
                    @csrf
					@method('PATCH')

                    <div class="block">
                        <label for="description" class="font-bold text-base text-black block mb-3">
                            {{ __('Description') }}
                        </label>
                        <input type="text" placeholder="{{ __('Meeting description') }}" name="description" value="{{ $meeting->description }}"
							class="w-full border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color
							outline-none focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					<div class="mt-8">
                        <label for="time" class="font-bold text-base text-black block mb-3">
                            {{ __('Time') }}
                        </label>
                        <input type="datetime-local" name="time" placeholder="{{ __('Meeting time') }}" value="{{ $meeting->time }}" class="w-full
							border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none
							focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					@php $i = 0; @endphp

					<div class="mt-8">
						<livewire:search-model :modelPassed="'User'" :label="'User'" :model_id="$meeting->user->id" :modelSearch="$meeting->user->name"
							:multiple="true" :count="$i++" />
                    </div>

					<div class="mt-8 grid grid-cols-2 gap-x-2">
						<livewire:select-client-type :clientTypes="[\App\Models\Client\Organization::class, \App\Models\Client\Person::class]"
							:clientType="substr($meeting->client::class, 18)" />
						<livewire:search-client :namespace="'App\Models\Client\\'" :client_type="substr($meeting->client::class, 18)" :modelName="'Client'"
							:label="'Client'" :model_id="$meeting->client->id" :modelSearch="$meeting->client->name" :multiple="true" :count="$i++" />
					</div>

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    	focus:outline-none focus:shadow-outline font-bold cursor-pointer">
                </form>
            </div>
        </div>
    </main>
@endsection