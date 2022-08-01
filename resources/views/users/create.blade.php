@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Create user') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="block">
                        <label for="name" class="font-bold text-base text-black block mb-3">
                            {{ __('Name') }}
                        </label>
                        <input type="text" placeholder="{{ __('User name') }}" name="name" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

                    <div class="mt-8">
                        <label for="email" class="font-bold text-base text-black block mb-3">
                            {{ __('Email') }}
                        </label>
                        <input type="email" placeholder="{{ __('User email') }}" name="email" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					<div class="mt-8">
                        <label for="password" class="font-bold text-base text-black block mb-3">
                            {{ __('Password') }}
                        </label>
                        <input type="password" name="password" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

					<div class="mt-8">
                        <label for="password_confirmation" class="font-bold text-base text-black block mb-3">
                            {{ __('Confirm password') }}
                        </label>
                        <input type="password" name="password_confirmation" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

                    <div class="mt-8">
                        <label for="role" class="font-bold text-base text-black block mb-3">
                            {{ __('Role') }}
                        </label>
                        <select name="role" class="w-full border-[1.5px] border-form-stroke rounded-lg py-3 px-5 font-medium text-body-color
                            outline-none focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD]
                            disabled:cursor-default appearance-none">
                            
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ __($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    focus:outline-none focus:shadow-outline font-bold cursor-pointer">
                </form>
            </div>
        </div>
    </main>
@endsection