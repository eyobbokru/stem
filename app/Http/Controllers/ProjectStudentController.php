<?php

namespace App\Http\Controllers;

use App\Models\ProjectStudent;
use App\Http\Requests\StoreProjectStudentRequest;
use App\Http\Requests\UpdateProjectStudentRequest;

class ProjectStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreProjectStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectStudentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectStudent  $projectStudent
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectStudent $projectStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectStudent  $projectStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectStudent $projectStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectStudentRequest  $request
     * @param  \App\Models\ProjectStudent  $projectStudent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectStudentRequest $request, ProjectStudent $projectStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectStudent  $projectStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectStudent $projectStudent)
    {
        //
    }
}
