<?php

namespace App\Http\Controllers\Admin;

use App\Models\GradeStudent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeStudentRequest;
use App\Http\Requests\UpdateGradeStudentRequest;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class GradeStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:gradeStudent list', ['only' => ['index', 'show']]);
        $this->middleware('can:gradeStudent create', ['only' => ['create', 'store']]);
        $this->middleware('can:gradeStudent edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:gradeStudent delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/GradeStudent/Index', [
            'gradeStudents' => GradeStudent::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })

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
        return Inertia::render('Admin/GradeStudent/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGradeStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradeStudentRequest $request)
    {
        GradeStudent::create([
            'name' => Request::input('name')
        ]);
        return Redirect::route('admin.gradeStudent.index')->with('flash.banner', 'Grade Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradeStudent  $gradeStudent
     * @return \Illuminate\Http\Response
     */
    public function show(GradeStudent $gradeStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradeStudent  $gradeStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(GradeStudent $gradeStudent)
    {
        return Inertia::render('Admin/GradeStudent/Edit', [
            'gradeStudent' => $gradeStudent,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGradeStudentRequest  $request
     * @param  \App\Models\GradeStudent  $gradeStudent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradeStudentRequest $request, GradeStudent $gradeStudent)
    {
        $gradeStudent->update([
            'name' => Request::input('name')
        ]);
        return Redirect::route('admin.gradeStudent.index')->with('flash.banner', 'Grade Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradeStudent  $gradeStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradeStudent $gradeStudent)
    {
        $gradeStudent->delete();
        return Redirect::route('admin.gradeStudent.index')->with('flash.banner', 'Grade deleted.')->with('flash.bannerStyle', 'danger');
    }
}
