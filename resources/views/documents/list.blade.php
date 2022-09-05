@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Documents') }}</h1>
        </div>

        <div class="flex flex-col w-full h-full px-10 pt-12 pb-10 bg-gray-200">
			@can('create-documents')
				<div class="mb-6">
					<a href="{{ route('documents.create') }}" class="text-xl bg-green-500 hover:bg-green-700 text-white py-3 px-6 rounded
						focus:outline-none focus:shadow-outline font-bold">
						{{ __('Upload document') }}
					</a>
				</div>
			@endcan
			
            <div class="w-full bg-white">
                <div class="text-gray-900 bg-gray-200">
                    <div class="flex justify-center">
                        <table class="w-full text-md bg-white shadow-md rounded mb-4">
                            <tbody>
                                <tr class="border-b">
									<th class="text-left p-3 px-5">{{ __('No.') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('File name') }}</th>
									<th class="text-left p-3 px-5">{{ __('Type') }}</th>
                                    <th class="text-left p-3 px-5">{{ __('Description') }}</th>
									<th class="text-left p-3 px-5">{{ __('Uploaded by') }}</th>
									<th class="text-left p-3 px-5">{{ __('Action') }}</th>
                                </tr>
                                
                                @foreach ($documents as $key => $document)
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                        <td class="p-3 px-5">{{ $key + 1 }}</td>
										<td class="p-3 px-5">{{ str_replace('_', ' ', $document->file_name) }}</td>
										<td class="p-3 px-5">{{ strtoupper(substr($document->extension, 1)) }}</td>
										<td class="p-3 px-5">{{ $document->description }}</td>
										
										<td class="p-3 px-5">
											@can('edit-users')
												<a href="{{ route('users.edit', ['user' => $document->user]) }}">
													{{ $document->user->name }}
												</a>
											@else
												{{ $document->user->name }}
											@endcan
										</td>

										@can('delete-projects')
											<td class="p-3 px-5 flex">
												<a href="{{ route('documents.download', compact('document')) }}" class="mr-1 text-sm bg-gray-500 hover:bg-gray-700 
													text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
													{{ __('Download') }}
												</a>
												<form action="{{ route('documents.destroy', compact('document')) }}" method="POST">
													@csrf
													@method('DELETE')

													<button class="ml-1 text-sm bg-red-500 hover:bg-red-700 text-white 
														py-2 px-4 rounded focus:outline-none focus:shadow-outline">
														{{ __('Delete') }}
													</button>
												</form>
											</td>
										@endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
					{{ $documents->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection