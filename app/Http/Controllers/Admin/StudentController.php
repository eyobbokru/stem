<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Grade;
use App\Models\Group;
use App\Models\School;
use App\Models\Student;
use App\Models\GradeStudent;
use App\Models\AcademicSession;
use App\Http\Controllers\Controller;
use App\Models\AcademicSessionCourse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:student list', ['only' => ['index', 'show']]);
        $this->middleware('can:student create', ['only' => ['create', 'store']]);
        $this->middleware('can:student edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:student delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/Student/Index', [
            'students' => Student::query()
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
        $school = School::all();
        $grade = GradeStudent::all();
        $academic_sessions = AcademicSession::with('section')->orderBy('created_at', 'desc')->get();

        return Inertia::render('Admin/Student/Create', [
            'schools' => $school,
            'grades' => $grade,
            'academic_sessions' => $academic_sessions,
            //  'groups' => $groups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {


        // $student =  Student::create([
        //     'name' => Request::input('name'),
        //     'fname' => Request::input('fname'),
        //     'lname' => Request::input('lname'),
        //     'age' => Request::input('age'),
        //     'sex' => Request::input('sex'),
        //     'school_id' => Request::input('school_id'),
        //     'grade_id' => Request::input('grade_id'),
        //     'academic_session_id' => Request::input('academic_session_id'),
        //     'group_id' => Request::input('group_id'),

        // ]);
        $student =  Student::create($request->all());


        // from AcademicSessionCourse where get id 
        $courses = AcademicSessionCourse::where('academic_session_id', Request::input('academic_session_id'))->get();

        // Grade course 
        //TODO change to queue or observer
        //TODO what if he got promoted 
        // 'score'
        foreach ($courses as $course) {
            Grade::create([
                'student_id' => $student->id,
                'course_id' => $course->course_id,
                'academic_session_id' => Request::input('academic_session_id'),
                'group_id' => Request::input('grade_id'),

            ]);
        }

        return Redirect::route('admin.student.index')->with('flash.banner', 'Student Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $school = School::all();
        $grade = GradeStudent::all();
        return Inertia::render('Admin/Student/Edit', [
            'schools' => $school,
            'grades' => $grade,
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update([
            'name' => Request::input('name'),
            'fname' => Request::input('fname'),
            'lname' => Request::input('lname'),
            'age' => Request::input('age'),
            'sex' => Request::input('sex'),
            'school_id' => Request::input('school_id'),
            'grade_id' => Request::input('grade_id'),
            'academic_session_id' => Request::input('academic_session_id'),
            'group_id' => Request::input('group_id'),

        ]);
        //TODO update course
        return Redirect::route('admin.student.index')->with('flash.banner', 'Student Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {

        $student->delete();
        return Redirect::route('admin.student.index')->with('flash.banner', 'student deleted.')->with('flash.bannerStyle', 'danger');
    }
}
