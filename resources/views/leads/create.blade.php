@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Create new lead') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('leads.store') }}" method="POST">
                    @csrf

                    <div class="block">
                        <label for="name" class="font-bold text-base text-black block mb-3">
                            {{ __('Title') }}
                        </label>
                        <input type="text" placeholder="{{ __('Lead title') }}" name="name" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

                    <div class="mt-8">
                        <label for="description" class="font-bold text-base text-black block mb-3">
                            {{ __('Description') }}
                        </label>
                        <textarea placeholder="{{ __('Lead description') }}" name="description" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default"></textarea>
                    </div>

					<div class="mt-8">
                        <label for="source" class="font-bold text-base text-black block mb-3">
                            {{ __('Source') }}
                        </label>
						<select name="source" class="w-full border-[1.5px] border-form-stroke
							rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
							active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
							<option>{{ __('Select source') }}</option>
							<option value="facebook">{{ __('Facebook') }}</option>
							<option value="instagram">{{ __('Instagram') }}</option>
							<option value="linkedin">{{ __('LinkedIn') }}</option>
							<option value="other">{{ __('Other') }}</option>
						</select>
                    </div>

					<div class="mt-8">
                        <label for="lead_value" class="font-bold text-base text-black block mb-3">
                            {{ __('Lead value') }}
                        </label>
						<input type="number" step=".01" placeholder="{{ __('Lead value') }}" name="lead_value" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
					</div>

					@php $i = 0; @endphp

					<div class="mt-8">
						<livewire:search-model :modelPassed="'User'" :label="'Sales owner'" :multiple="true" :count="$i++" />
                    </div>

					<div class="mt-8 grid grid-cols-2 gap-x-2">
						<livewire:select-client-type :clientTypes="[\App\Models\Client\Organization::class, \App\Models\Client\Person::class]" />
						<livewire:search-client :namespace="'App\Models\Client\\'" :modelName="'Client'" :label="'Contact'" :multiple="true" :count="$i++" />
					</div>

					<div class="mt-8">
						<livewire:products />
					</div>

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    	focus:outline-none focus:shadow-outline font-bold cursor-pointer">
                </form>
            </div>
        </div>
    </main>
@endsection