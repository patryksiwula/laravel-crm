<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;

class SearchClient extends SearchModel
{
	public string $client_type;
	public string $modelName;

	protected $listeners = ['clientTypeSelected'];

	public function mount(): void
	{
		parent::mount();
		
		if (empty($this->client_type) || $this->client_type === null)
			$this->client_type = 'Organization';

		$this->model = $this->namespace . $this->client_type;
		$this->model_type = $this->model;
	}

	public function render()
    {
		$models = new Collection();

		if (!empty($this->modelSearch) && !empty($this->model))
			$models = $this->model::where('name', 'like', '%' . $this->modelSearch . '%')->get(['id', 'name']);

		$this->showDropdown = (!empty($this->modelSearch) && $models->isNotEmpty()) ? true : false;

		//dd($this->client_type);

        return view('livewire.search-client', compact('models'));
    }

	public function clientTypeSelected(string $type): void
	{
		$this->client_type = $type;
		$this->model = 'App\Models\Client\\' . $type;
		$this->model_type = $this->model;
	}
}
