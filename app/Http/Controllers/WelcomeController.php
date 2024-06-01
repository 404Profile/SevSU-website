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
//        dd(Project::query()->where('group', 'ИТ/б-22-2-о')->get());
        $projects = Project::query()->with('team')->when(FilterRequest::input('search'), function ($query, $search) {
            $query->where('title', 'LIKE', "%{$search}%");
        })->when(FilterRequest::input('group') ?? null, function ($query, $group) {
            $query->where('group', $group);
        })->paginate()->withQueryString();
        return Inertia::render('Welcome', [
            'projects' => $projects,
        ]);
    }

}
