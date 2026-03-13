<?php

namespace App\Http\Controllers\Web;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index');
    }
}
