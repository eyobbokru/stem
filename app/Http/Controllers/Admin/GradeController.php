<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Student;
use App\Models\AcademicSession;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Req;
use Illuminate\Support\Facades\Request;

use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // get academic session with course and edit grade 
        $academicSession = AcademicSession::with('section')->orderBy('created_at', 'desc')->get();


        $perPage = Request::input('perPage') ?: 5;

        $group_id = 0;
        $group_id = Group::where('academic_session_id', Request::input('academicSession') ?: $academicSession[0]->id)
            ->where('name', 'like', Request::input('group') ?: 'Group-1')->first();
        // dd($group_id ? $group_id->id : 0);

        return Inertia::render('Admin/Grade/Index', [
            'students' => Student::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->when(Request::input('academicSession'), function ($query, $academicSession) {
                    $query->where('academic_session_id', 'like', "%{$academicSession}%");
                })
                ->when(Request::input('group'), function ($query) use ($group_id) {
                    $query->where('group_id', $group_id ? $group_id->id : 0);
                })

                ->paginate($perPage)
                ->withQueryString(),

            'filters' => Request::only(['search', 'perPage', 'group', 'academicSession', 'subject']),
            'academicSessions' => $academicSession,


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
     * @param  \App\Http\Requests\StoreGradeRequest  $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreGradeRequest $request)
    public function store(Req $request)
    {
        //dd($request->input());
        foreach ($request->input() as $inputStudent) {
            foreach ($inputStudent as $input) {
                //dd($input["id"]);
                $grade = Grade::find($input["id"]);
                $grade->update(['score' => $input["score"]]);
            }
        }
        return back()->with('flash.banner', 'Saved successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGradeRequest  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradeReport  $gradeReport
     * @return \Illuminate\Http\Response
     */
    public function grade(Request $request)
    {
        //  dd(Request::input('academicSession'));

        $academicSession1 = AcademicSession::with('section')->orderBy('created_at', 'desc')->get();


        $perPage = Request::input('perPage') ?: 5;

        $group_id = 0;
        $group_id = Group::where('academic_session_id', Request::input('academicSession') ?: $academicSession1[0]->id)
            ->where('name', 'like', Request::input('group') ?: 'Group-1')->first();

        // sorted bay name 
        $student = Student::query()
            ->leftJoin('grades', 'students.id', '=', 'grades.student_id')
            ->Join('courses', 'grades.course_id', 'courses.id')
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('students.name', 'like', "%{$search}%");
            })
            ->when(Request::input('academicSession'), function ($query, $academicSession) {
                $query->where('students.academic_session_id', 'like', "%{$academicSession}%");
            })
            ->when(Request::input('group'), function ($query) use ($group_id) {
                $query->where('students.group_id', $group_id ? $group_id->id : 0);
            })

            ->select('students.name', 'students.fname', 'students.lname', 'grades.*', 'courses.name as course_name')
            ->get();

        //get number of course considering that all students take same course 
        $course  = Student::query()
            ->leftJoin('grades', 'students.id', '=', 'grades.student_id')
            ->Join('courses', 'grades.course_id', 'courses.id')
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('students.name', 'like', "%{$search}%");
            })
            ->when(Request::input('academicSession'), function ($query, $academicSession) {
                $query->where('students.academic_session_id', 'like', "%{$academicSession}%");
            })
            ->when(Request::input('group'), function ($query) use ($group_id) {
                $query->where('students.group_id', $group_id ? $group_id->id : 0);
            })
            ->distinct('course_id')
            ->count('course_id');
        // dd($course);
        $course_list = array();
        $student_list = array();

        $students = $student->chunk($course)->all();

        foreach ($students as $std) {
            foreach ($std as $stud) {
                array_push($course_list, $stud->course_name);
            }
            break;
        }

        foreach ($students as $std) {
            foreach ($std as $stud) {
                // array_push($student_list, $stud->name . $stud->fname);
                array_push($student_list, $stud->name);
                break;
            }
        }
        // dd($student_list);
        //TODO CHECK  logic 

        // change to this format 
        /* student_id {
                name, 
                subject
         }  
        */

        return Inertia::render('Admin/Grade/Edit', [
            'students' => $students,
            'course' => $course_list,
            'student_list' => $student_list
        ]);
    }
}
