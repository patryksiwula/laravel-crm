@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Edit lead') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('leads.update', compact('lead')) }}" method="POST">
                    @csrf
					@method('PATCH')

                    <div class="block">
                        <label for="name" class="font-bold text-base text-black block mb-3">
                            {{ __('Title') }}
                        </label>
                        <input type="text" placeholder="{{ __('Lead title') }}" name="name" value="{{ $lead->name }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

                    <div class="mt-8">
                        <label for="description" class="font-bold text-base text-black block mb-3">
                            {{ __('Description') }}
                        </label>
                        <textarea placeholder="{{ __('Lead description') }}" name="description" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">{{ $lead->description }}</textarea>
                    </div>

					<div class="mt-8">
                        <label for="source" class="font-bold text-base text-black block mb-3">
                            {{ __('Source') }}
                        </label>
						<select name="source" class="w-full border-[1.5px] border-form-stroke
							rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
							active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
							<option disabled>{{ __('Select source') }}</option>
							<option value="facebook" @selected($lead->source === 'facebook')>{{ __('Facebook') }}</option>
							<option value="instagram" @selected($lead->source === 'instagram')>{{ __('Instagram') }}</option>
							<option value="linkedin" @selected($lead->source === 'linkedin')>{{ __('LinkedIn') }}</option>
							<option value="other" @selected($lead->source === 'other')>{{ __('Other') }}</option>
						</select>
                    </div>

					<div class="mt-8">
                        <label for="stage" class="font-bold text-base text-black block mb-3">
                            {{ __('Stage') }}
                        </label>
						<select name="stage" class="w-full border-[1.5px] border-form-stroke
							rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
							active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
							<option disabled>{{ __('Select stage') }}</option>
							<option value="new" @selected($lead->stage === 'new')>{{ __('New') }}</option>
							<option value="negotiation" @selected($lead->stage === 'negotiation')>{{ __('Negotiation') }}</option>
							<option value="won" @selected($lead->stage === 'won')>{{ __('Won') }}</option>
							<option value="lost" @selected($lead->stage === 'lost')>{{ __('Lost') }}</option>
						</select>
                    </div>

					<div class="mt-8">
                        <label for="lead_value" class="font-bold text-base text-black block mb-3">
                            {{ __('Lead value') }}
                        </label>
						<input type="number" step=".01" placeholder="{{ __('Lead value') }}" name="lead_value" value="{{ $lead->lead_value }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
					</div>

					@php $i = 0; @endphp

					<div class="mt-8">
						<livewire:search-model :modelPassed="'User'" :label="'Sales owner'" :model_id="$lead->user->id"
							:modelSearch="$lead->user->name" :multiple="true" :count="$i++" />
                    </div>

					<div class="mt-8 grid grid-cols-2 gap-x-2">
						<livewire:select-client-type :clientTypes="[\App\Models\Client\Organization::class, \App\Models\Client\Person::class]"
							:clientType="substr($lead->client::class, 18)" />
							
						<livewire:search-client :namespace="'App\Models\Client\\'" :modelName="'Client'" :label="'Contact'" :model_id="$lead->client->id"
							:client_type="substr($lead->client::class, 18)" :modelSearch="$lead->client->name" :multiple="true" :count="$i++" />
					</div>

					<div class="mt-8">
						<livewire:products :modelProducts="new \Illuminate\Support\Collection($lead->products)" :model="$lead" />
					</div>

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    	focus:outline-none focus:shadow-outline font-bold cursor-pointer">
                </form>
            </div>
        </div>
    </main>
@endsection