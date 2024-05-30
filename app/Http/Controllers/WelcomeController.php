<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FilterRequest;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $projects = Project::query()->with('team')->when(FilterRequest::input('search'), function ($query, $search) {
            $query->where('title', 'LIKE', "%{$search}%");
        })->paginate()->withQueryString();
        return Inertia::render('Welcome', [
            'projects' => $projects,
        ]);
    }

}
