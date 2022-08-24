@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Creating new invoice') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf

                    <div class="block">
                        <label for="invoice_no" class="font-bold text-base text-black block mb-3">
                            {{ __('Invoice no.') }}
                        </label>
                        <input type="text" placeholder="{{ __('Invoice no.') }}" name="invoice_no" disabled class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">

						<input type="hidden" name="invoice_number">
                    </div>

                    <div class="mt-8">
                        <label for="invoice_date" class="font-bold text-base text-black block mb-3">
                            {{ __('Invoice date') }}
                        </label>
                        <input type="date" name="invoice_date" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					<div class="mt-8">
                        <label for="sale_date" class="font-bold text-base text-black block mb-3">
                            {{ __('Sale date') }}
                        </label>
                        <input type="date" name="sale_date" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					<div class="mt-8">
                        <label for="due_date" class="font-bold text-base text-black block mb-3">
                            {{ __('Due date') }}
                        </label>
                        <input type="date" name="due_date" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					<div class="mt-8">
                        <label for="payment_method" class="font-bold text-base text-black block mb-3">
                            {{ __('Payment method') }}
                        </label>
						<select name="payment_method" class="w-full border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium
						text-body-color outline-none focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default
						appearance-none">
							<option value="cash">Cash</option>
							<option value="bank transfer">Bank transfer</option>
							<option value="credit card">Credit card</option>
						</select>
                    </div>

					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    focus:outline-none focus:shadow-outline font-bold cursor-pointer">
                </form>
            </div>
        </div>
    </main>
@endsection