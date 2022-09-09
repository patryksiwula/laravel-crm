<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(DashboardService $dashboardService): View
	{
		$data = $dashboardService->getData();

		return view('dashboard', $data);
	}
}
