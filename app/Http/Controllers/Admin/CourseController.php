<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/Course/Index', [
            'courses' => Course::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->with('lecturer')
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
        $lecture = Teacher::where('Type', 'Lecturer')->get();
        $lab_assistance = Teacher::where('Type', 'Lab Assistance')->get();
        return Inertia::render('Admin/Course/Create', [
            'lecturers' => $lecture,
            'labAssistances' => $lab_assistance
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        Course::create([
            'name' => Request::input('name'),
            'totalLecPerWeek' => Request::input('totalLecPerWeek'),
            'totalLabPerWeek' => Request::input('totalLabPerWeek'),
            'responsible_lec_id' => Request::input('responsible_lec_id'),
            'responsible_lab_id' => Request::input('responsible_lab_id'),

        ]);
        return Redirect::route('admin.course.index')->with('flash.banner', 'Course Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $lecture = Teacher::where('Type', 'Lecturer')->get();
        $lab_assistance = Teacher::where('Type', 'Lab Assistance')->get();
        return Inertia::render('Admin/Course/Edit', [
            'course' => $course,
            'lecturers' => $lecture,
            'labAssistances' => $lab_assistance
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update([
            'name' => Request::input('name'),
            'totalLecPerWeek' => Request::input('totalLecPerWeek'),
            'totalLabPerWeek' => Request::input('totalLabPerWeek'),
            'responsible_lec_id' => Request::input('responsible_lec_id'),
            'responsible_lab_id' => Request::input('responsible_lab_id'),

        ]);
        return Redirect::route('admin.course.index')->with('flash.banner', 'Course Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return Redirect::route('admin.course.index')->with('flash.banner', 'course deleted.')->with('flash.bannerStyle', 'danger');
    }
}
