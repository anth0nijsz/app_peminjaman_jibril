<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('admin.dashboard');
        } elseif ($user->isOperator()) {
            return view('operator.dashboard');
        } else {
            return view('member.dashboard');
        }
    }
}
