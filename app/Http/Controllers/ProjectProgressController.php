<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;


use App\Models\ProjectProgress;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
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
    public function edit($id)
    {
      
        $project = Project::findOrFail($id);

        
       
        return Inertia::render('Admin/ProjectProgress/Edit', [
             'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectProgressRequest  $request
     * @param  \App\Models\ProjectProgress  $projectProgress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //  dd(Request::input('progressReport'));

        $project = Project::findOrFail($id);
        $filePath = Null;

        $progress = new ProjectProgress();
        $progress->progressReport = Request::input('progressReport');
        $progress->project_id = $project->id;


        // store the file
        if (Request::hasFile('image_video')) {
            $file = Request::file('image_video');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/files'), $filename);

            $progress->image_video = Request::file('image_video')->store('files/' .$filename, 'public');
 
        } else {
            $progress->image_video = Null;
        }

        $progress->save();

        return Redirect::route('admin.projectProgress.index')->with('flash.banner', 'Progress add successfully');

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
