<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationRequest;
use App\Services\ConfigurationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ConfigurationController extends Controller
{	
	/**
	 * Show all configurations
	 *
	 * @return \Illuminate\Contracts\View\View
	 */
	public function index(): View
	{
		$configs = DB::table('configs')->select(['name', 'value'])
			->get();

		return view('configs.list', compact('configs'));
	}
	
    /**
     * Show the form for editing configuration.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(): View
    {
        $this->authorize('edit-configs');
		$configs = DB::table('configs')->select(['name', 'value'])
			->get();

		return view('configs.edit', compact('configs'));
    }

    /**
     * Update the configuration.
     *
     * @param  \App\Http\Requests\ConfigurationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ConfigurationRequest $request, ConfigurationService $configurationService): RedirectResponse
    {
        $this->authorize('edit-configs');
		$configurationService->updateConfiguration($request->validated());

		return redirect()->route('configs.index')
			->with('action', 'config_updated');
    }
}
