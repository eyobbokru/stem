<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Models\Student;
use App\Models\GradeReport;
use App\Models\AcademicSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreGradeReportRequest;
use App\Http\Requests\UpdateGradeReportRequest;

class GradeReportController extends Controller
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
     * @param  \App\Http\Requests\StoreGradeReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradeReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradeReport  $gradeReport
     * @return \Illuminate\Http\Response
     */
    public function show(GradeReport $gradeReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradeReport  $gradeReport
     * @return \Illuminate\Http\Response
     */
    public function edit(GradeReport $gradeReport)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGradeReportRequest  $request
     * @param  \App\Models\GradeReport  $gradeReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradeReportRequest $request, GradeReport $gradeReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradeReport  $gradeReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradeReport $gradeReport)
    {
        //
    }
}
