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

                    <button type="submit" class="flex items-center justify-center mt-10 text-lg bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded
                    	focus:outline-none focus:shadow-outline font-bold cursor-pointer">
						<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
							<g>
								<rect fill="none" height="24" width="24"/>
							</g>
							<g>
								<path d="M7.4,10h1.59v5c0,0.55,0.45,1,1,1h4c0.55,0,1-0.45,1-1v-5h1.59c0.89,0,1.34-1.08,0.71-1.71L12.7,3.7 c-0.39-0.39-1.02-0.39-1.41,0L6.7,8.29C6.07,8.92,6.51,10,7.4,10z M5,19c0,0.55,0.45,1,1,1h12c0.55,0,1-0.45,1-1s-0.45-1-1-1H6 C5.45,18,5,18.45,5,19z"/>
							</g>
						</svg>
						<span>{{ __('Upload') }}</span>
					</button>
                </form>
            </div>
        </div>
    </main>
@endsection