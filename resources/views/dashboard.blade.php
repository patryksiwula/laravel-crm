@extends('layouts.app')

@section('content')
    <main class="min-h-screen w-full ml-60 bg-gray-200">
        <div class="w-full py-5 text-center bg-white shadow-sm">
            <h1 class="text-xl font-bold">{{ __('Dashboard') }}</h1>
        </div>
        <div class="w-full h-full p-20 bg-gray-200">
				<div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8">
					<x-bladewind.card :class="'w-full h-full flex justify-center'">
						<div style="display: flex; align-items: center; height: 30rem; width: 100%;">
							<livewire:livewire-pie-chart :pie-chart-model="$allTasks" />
						</div>
					</x-bladewind.card>

					<x-bladewind.card :class="'w-full h-full flex justify-center'">
						<div style="display: flex; align-items: center; height: 30rem; width: 100%;">
							<livewire:livewire-pie-chart :pie-chart-model="$allProjects" />
						</div>
					</x-bladewind.card>

					<x-bladewind.card :class="'w-full h-full flex justify-center'">
						<x-projects :projects="$userProjects" />
					</x-bladewind.card>

					<x-bladewind.card :class="'w-full h-full flex justify-center'">
						<x-tasks :tasks="$userTasks" />
					</x-bladewind.card>

					<x-bladewind.card :class="'w-full h-full flex justify-center'">
						<x-meetings :meetings="$meetings" />
					</x-bladewind.card>
				</div>
        </div>
    </main>
@endsection