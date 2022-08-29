@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Creating new invoice') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
				<h2 class="text-2xl font-semibold">{{ __('Invoice details') }}</h2>
			
				<livewire:dynamic-invoice-create />
			</div>
			
        </div>
    </main>
@endsection