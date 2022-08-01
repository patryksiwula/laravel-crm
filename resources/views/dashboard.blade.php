@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Dashboard') }}</h1>
        </div>

        <div class="w-full h-full p-6 bg-gray-200">
            <div class="w-full h-full bg-white">
                {{ __('Test') }}
            </div>
        </div>
    </main>
@endsection