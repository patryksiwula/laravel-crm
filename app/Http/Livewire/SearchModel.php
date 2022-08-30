<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class SearchModel extends Component
{
	public string $namespace;
	public string $model;
	public string $modelSearch;
	public string $client_type;
	public bool $showDropdown;
	public mixed $modelSelected;
	public int $model_id;
	public string $model_type;

	protected $listeners = ['clientTypeSelected'];

	public function mount(): void
	{
		$this->client_type = 'Organization';
		$this->model = $this->namespace . $this->client_type;
		$this->modelSearch = '';
		$this->showDropdown = false;
		$this->modelSelected = null;
		$this->model_id = 0;
		$this->model_type = $this->model;
	}

    public function render()
    {
		$models = new Collection();

		if (!empty($this->modelSearch))
			$models = $this->model::where('name', 'like', '%' . $this->modelSearch . '%')->get(['id', 'name']);

		$this->showDropdown = (!empty($this->modelSearch) && $models->isNotEmpty()) ? true : false;

        return view('livewire.search-model', compact('models'));
    }

	public function clientTypeSelected(string $type): void
	{
		$this->client_type = $type;
		$this->model = 'App\Models\Client\\' . $type;
		$this->model_type = $this->model;
	}

	public function setModel(int $modelId): void
	{
		$this->modelSelected = $this->model::find($modelId, ['id', 'name']);
		$this->modelSearch = $this->modelSelected->name;
		$this->model_id = $modelId;
	}
}
