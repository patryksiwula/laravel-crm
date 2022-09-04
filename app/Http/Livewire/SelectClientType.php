<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectClientType extends Component
{
	public array $clientTypes;
	public string $clientType;

	public function mount(): void
	{
		if (empty($this->clientType) || $this->clientType === null)
			$this->clientType = 'Organization';
	}

    public function render()
    {
        return view('livewire.select-client-type');
    }

	public function setClientType(): void
	{
		$this->emit('clientTypeSelected', $this->clientType);
	}
}
