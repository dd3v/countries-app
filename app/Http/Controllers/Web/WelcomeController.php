<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function __invoke(): RedirectResponse|View
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('welcome');
    }
}
