<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FilterRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::query()->when(FilterRequest::input('search'), function ($query, $search) {
            $query->where('title', 'LIKE', "%{$search}%");
        })->paginate()->withQueryString();
        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'filters' => FilterRequest::all('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Projects/Create', [
            'filters' => FilterRequest::all('search'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:4000000000'],
            'project_photo_path' => ['required', 'mimes:jpg,jpeg,png', 'max:3072'],
            'presentation_path' => ['nullable', 'mimes:pdf', 'max:5120'],
        ])->validate();

        $project = new project();
        $project->title = $request['title'];
        $project->description = $request['description'];

        if ($request['project_photo_path']) {
            $pathPhoto = $request->file('project_photo_path')->store('projects', 'public');
            $namePhoto = $request->file('project_photo_path')->hashName();
            $project->project_photo_path = $namePhoto;
        } else {
            $project->project_photo_path = null;
        }

        if ($request['presentation_path']) {
            $pathPdf = $request->file('presentation_path')->store('projects', 'public');
            $namePdf = $request->file('presentation_path')->hashName();
            $project->presentation_path = $namePdf;
        } else {
            $project->presentation_path = null;
        }
        $project->team = Auth::user()->currentTeam->id;
        $project->save();

        return Redirect::route('projects.index')->with('success', 'Проект успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return Inertia::render('Projects/Show', [
            'project' => $project->load('team'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit', [
            'project' => $project->load('team'),
            'filters' => FilterRequest::all('search'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:4000000000'],
        ])->validate();

        $project->forceFill([
            'title' => $request['title'],
            'description' => $request['description'],
        ])->save();

        return Redirect::route('projects.index')->with('success', 'Проект был успешно обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return Redirect::route('projects.index')->with('success', 'Проект был успешно удален.');
    }
}
