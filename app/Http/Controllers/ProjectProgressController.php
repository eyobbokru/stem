<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use App\Models\ProjectProgress;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreProjectProgressRequest;
use App\Http\Requests\UpdateProjectProgressRequest;

class ProjectProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/ProjectProgress/Index', [
            'projects' => Project::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectProgressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectProgressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectProgress  $projectProgress
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectProgress $projectProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectProgress  $projectProgress
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectProgress $projectProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectProgressRequest  $request
     * @param  \App\Models\ProjectProgress  $projectProgress
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectProgressRequest $request, ProjectProgress $projectProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectProgress  $projectProgress
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectProgress $projectProgress)
    {
        //
    }
}
