<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $authUserTeams = Auth::user()->allTeams()->load('project', 'owner', 'users');
        return Inertia::render('Dashboard', [
            'authUserTeams' => $authUserTeams,
        ]);
    }
}
