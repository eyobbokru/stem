<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Group;
use App\Models\Course;

use App\Models\AcademicSession;
use App\Http\Controllers\Controller;
use App\Models\AcademicSessionCourse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreAcademicSessionRequest;
use App\Http\Requests\UpdateAcademicSessionRequest;

class AcademicSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/AcademicSession/Index', [
            'academicSessions' => AcademicSession::query()
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
        $course = Course::all();

        return Inertia::render('Admin/AcademicSession/Create', [
            'courses' => $course,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAcademicSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcademicSessionRequest $request)
    {

        $academicSession =  AcademicSession::create([
            'name' => Request::input('name'),
            'academicYear' => Request::input('academicYear'),
            'startingDate' =>  Carbon::parse(Request::input('startingDate')),
            'endingDate' =>  Carbon::parse(Request::input('endingDate')),
            'type' => Request::input('type')["name"],
        ]);

        for ($i = 0; $i < (int)Request::input('group'); $i++) {

            Group::create([
                'name' => 'Group-' . $i + 1,
                'academic_session_id' => $academicSession->id
            ]);
        }
        // TODO courseSession
        foreach (Request::input('selectCourse') as $course) {

            AcademicSessionCourse::create([
                'academic_session_id' => $academicSession->id,
                'course_id' => $course['id'],
            ]);
        }



        return Redirect::route('admin.academicSession.index')->with('flash.banner', 'Academic Session Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicSession  $academicSession
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicSession $academicSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicSession  $academicSession
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicSession $academicSession)
    {
        $course = Course::all();
        $academicSessions = AcademicSession::where('id', $academicSession->id)->with('courses')->first();

        return Inertia::render('Admin/AcademicSession/Edit', [
            'academicSession' => $academicSessions,
            'courses' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcademicSessionRequest  $request
     * @param  \App\Models\AcademicSession  $academicSession
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcademicSessionRequest $request, AcademicSession $academicSession)
    {

        // dd($request);
        //TODO type have problem change to appropriate format
        $academicSession->update([
            'name' => Request::input('name'),
            'academicYear' => Request::input('academicYear'),
            'startingDate' =>  Carbon::parse(Request::input('startingDate')),
            'endingDate' =>  Carbon::parse(Request::input('endingDate')),
            'type' => Request::input('type')["name"],
        ]);
        //TODO academic session update
        // change in the update
        // get all session courses
        $courses = AcademicSessionCourse::where('academic_session_id', $academicSession->id)->delete();

        // find and delete ifn't exist
        // when to delete
        // if exist in $course not in Request::input('selectCourse')
        // when to add
        // if exist Request::input('selectCourse') not $course

        foreach (Request::input('selectCourse') as $course) {

            AcademicSessionCourse::create([
                'academic_session_id' => $academicSession->id,
                'course_id' => $course['id'],
            ]);
        }


        // foreach (Request::input('selectCourse') as $toUPdateCourse) {

        //     foreach ($courses as $dbCourses) {
        //         if ($toUPdateCourse->id == $dbCourses->id) {
        //             continue;
        //         } else {
        //             AcademicSessionCourse::create([
        //                 'academic_session_id' => $academicSession->id,
        //                 'course_id' => $toUPdateCourse['id'],
        //             ]);
        //         }
        //     }

        //     AcademicSessionCourse::create([
        //         'academic_session_id' => $academicSession->id,
        //         'course_id' => $toUPdateCourse['id'],
        //     ]);
        // }

        // foreach (Request::input('selectCourse') as $toUPdateCourse) {

        //     foreach ($courses as $dbCourses) {
        //         if ($toUPdateCourse->id == $dbCourses->id) {
        //             continue;
        //         } else {
        //             AcademicSessionCourse::destroy($dbCourses->id);
        //         }
        //     }
        // }

        return Redirect::route('admin.academicSession.index')->with('flash.banner', 'Academic Session Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicSession  $academicSession
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicSession $academicSession)
    {
        $academicSession->delete();
        return Redirect::route('admin.academicSession.index')->with('flash.banner', 'Academic Session deleted.')->with('flash.bannerStyle', 'danger');
    }
}
