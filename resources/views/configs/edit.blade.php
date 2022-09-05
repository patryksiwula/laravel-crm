@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Updating configuration') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('configs.update') }}" method="POST">
                    @csrf
					@method('PATCH')

                    <div class="block">
                        <label for="name" class="font-bold text-base text-black block mb-3">
                            {{ __('Company name') }}
                        </label>
                        <input type="text" placeholder="{{ __('Company name') }}" name="name" value="{{ $configs->get(0)->value }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

                    <div class="mt-8">
                        <label for="email" class="font-bold text-base text-black block mb-3">
                            {{ __('Email address') }}
                        </label>
                        <input type="email" placeholder="{{ __('Email address') }}" name="email" value="{{ $configs->get(1)->value }}" class="w-full border-[1.5px]
							border-form-stroke rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					<div class="mt-8">
                        <label for="address" class="font-bold text-base text-black block mb-3">
                            {{ __('Address') }}
                        </label>
                        <input type="text" name="address" placeholder="{{ __('Company address') }}" value="{{ $configs->get(2)->value }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					<div class="mt-8 grid grid-cols-2 gap-2">
						<div>
							<label for="vat" class="font-bold text-base text-black block mb-3">
								{{ __('VAT number') }}
							</label>
							<input type="text" name="vat" placeholder="{{ __('Company VAT number') }}" value="{{ $configs->get(3)->value }}" class="w-full border-[1.5px] border-form-stroke
								rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
								active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
						</div>

						<div>
							<label for="tax" class="font-bold text-base text-black block mb-3">
								{{ __('TAX') }}
							</label>
							<input type="number" name="tax" placeholder="{{ __('TAX rate') }}" value="{{ $configs->get(4)->value }}" class="w-full border-[1.5px] border-form-stroke
								rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
								active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
						</div>
					</div>

					<div class="mt-8">
						<label for="date_format" class="font-bold text-base text-black block mb-3">
							{{ __('Date format') }}
						</label>
						<select name="date_format" placeholder="{{ __('Date display format') }}" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
							<option value="d.m.Y" @selected($configs->get(4)->value === 'd.m.Y')>{{ __('d.m.Y') }}</option>
							<option value="d-m-Y" @selected($configs->get(4)->value === 'd-m-Y')>{{ __('d-m-Y') }}</option>
							<option value="d/m/Y" @selected($configs->get(4)->value === 'd/m/Y')>{{ __('d/m/Y') }}</option>
							<option value="Y.m.d" @selected($configs->get(4)->value === 'Y.m.d')>{{ __('Y.m.d') }}</option>
							<option value="Y-m-d" @selected($configs->get(4)->value === 'Y-m-d')>{{ __('Y-m-d') }}</option>
							<option value="Y/m/d" @selected($configs->get(4)->value === 'Y/m/d')>{{ __('Y/m/d') }}</option>
						</select>
					</div>

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    	focus:outline-none focus:shadow-outline font-bold cursor-pointer">
                </form>
            </div>
        </div>
    </main>
@endsection