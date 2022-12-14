<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class SearchModel extends Component
{
	public string $namespace;
	public string|null $modelPassed;
	public string|null $model;
	public string $modelSearch;
	public bool $showDropdown;
	public mixed $modelSelected;
	public int $model_id;
	public string|null $model_type;
	public bool $multiple;
	public int $count;
	public string $label;

	public function mount(): void
	{
		if (empty($this->namespace))
			$this->namespace = 'App\Models\\';
			
		$this->model = (empty($this->modelPassed) || $this->modelPassed === null) ? '' : $this->namespace . $this->modelPassed;
		$this->showDropdown = false;
		$this->modelSelected = null;
		$this->model_type = $this->model;

		if (empty($this->modelSearch))
			$this->modelSearch = '';

		if (empty($this->model_id))
			$this->model_id = 0;

		if (empty($this->multiple))
			$this->multiple = false;

		if (empty($this->count))
			$this->count = 0;

		if (empty($this->label))
			$this->label = $this->modelPassed;
	}

    public function render()
    {
		$models = new Collection();

		if (!empty($this->modelSearch) && !empty($this->model))
			$models = $this->model::where('name', 'like', '%' . $this->modelSearch . '%')->get(['id', 'name']);

		$this->showDropdown = (!empty($this->modelSearch) && $models->isNotEmpty()) ? true : false;

        return view('livewire.search-model', compact('models'));
    }

	public function setModel(int $modelId): void
	{
		$this->modelSelected = $this->model::find($modelId, ['id', 'name']);
		$this->modelSearch = $this->modelSelected->name;
		$this->model_id = $modelId;
	}
}
