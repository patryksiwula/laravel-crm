@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Upload new document') }}</h1>
        </div>

        <div class="w-full h-full px-80 py-10 bg-gray-200">
            <div class="w-full bg-white p-8 shadow-md">
                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="block">
                        <label for="file_name" class="font-bold text-base text-black block mb-3">
                            {{ __('File name') }}
                        </label>
                        <input type="text" placeholder="{{ __('File name') }}" name="file_name" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default">
                    </div>

                    <div class="mt-8">
                        <label for="description" class="font-bold text-base text-black block mb-3">
                            {{ __('Description') }}
                        </label>
                        <textarea placeholder="{{ __('Document description') }}" name="description" class="w-full border-[1.5px] border-form-stroke
                            rounded-lg py-3 px-5 font-medium text-body-color placeholder-body-color outline-none focus:border-primary
                            active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default"></textarea>
                    </div>

					<div class="mt-8">
						<label for="file" class="font-bold text-base text-black block mb-3">
							{{ __('Document file') }}
						</label>
						<input required type="file" name="file" class="w-full border-[1.5px] border-form-strokerounded-lg font-medium text-body-color placeholder-body-color outline-none
							focus:border-primary active:border-primary transition disabled:bg-[#F5F7FD] disabled:cursor-default cursor-pointer file:bg-[#F5F7FD]
							file:border-0 file:border-solid file:border-r file:border-collapse file:border-form-stroke file:py-3 file:px-5 file:mr-5 file:text-body-color
							file:cursor-pointer file:hover:bg-primary file:hover:bg-opacity-10">
					</div>

					<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <input type="submit" class="mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    	focus:outline-none focus:shadow-outline font-bold cursor-pointer">

					{{ $errors }}
                </form>
            </div>
        </div>
    </main>
@endsection