@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('CRM Configuration') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 2xl:px-60 pt-12 pb-10 bg-gray-200">
			@can('edit-configs')
				<div class="mb-6">
					<a href="{{ route('configs.edit') }}" class="text-xl bg-blue-500 hover:bg-blue-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Edit configuration') }}
					</a>
				</div>
			@endcan

            <div class="w-full bg-white">
                <div class="text-gray-900 bg-gray-200">
                    <div class="flex justify-center">
                        <table class="w-full text-md bg-white shadow-md rounded mb-4">
                            <tbody>
                                <tr class="border-b">
                                    <th class="text-center p-3 px-5">{{ __('Config') }}</th>
									<th class="text-center p-3 px-5">{{ __('Value') }}</th>
                                </tr>
                                
								<tr class="border-b hover:bg-orange-100 bg-gray-100">
									<td class="text-center p-3 px-5">{{ __('Company name') }}</td>
									<td class="text-center p-3 px-5">{{ $configs->get(0)->value }}</td>
								</tr>

								<tr class="border-b hover:bg-orange-100 bg-gray-100">
									<td class="text-center p-3 px-5">{{ __('Email address') }}</td>
									<td class="text-center p-3 px-5">{{ $configs->get(1)->value }}</td>
								</tr>

								<tr class="border-b hover:bg-orange-100 bg-gray-100">
									<td class="text-center p-3 px-5">{{ __('Company address') }}</td>
									<td class="text-center p-3 px-5">{!! $configs->get(2)->value !!}</td>
								</tr>

								<tr class="border-b hover:bg-orange-100 bg-gray-100">
									<td class="text-center p-3 px-5">{{ __('VAT number') }}</td>
									<td class="text-center p-3 px-5">{{ $configs->get(3)->value }}</td>
								</tr>

								<tr class="border-b hover:bg-orange-100 bg-gray-100">
									<td class="text-center p-3 px-5">{{ __('TAX') }}</td>
									<td class="text-center p-3 px-5">{{ $configs->get(4)->value }}&percnt;</td>
								</tr>

								<tr class="border-b hover:bg-orange-100 bg-gray-100">
									<td class="text-center p-3 px-5">{{ __('Date display format') }}</td>
									<td class="text-center p-3 px-5">{{ $configs->get(5)->value }}</td>
								</tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection