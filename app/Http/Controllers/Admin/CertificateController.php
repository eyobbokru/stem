<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Group;
// use Illuminate\Http\Request;
use App\Models\Student;

use App\Models\AcademicSession;
use App\Http\Controllers\Controller;
use App\Models\ProjectStudent;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $academicSession = AcademicSession::with('section')->orderBy('created_at', 'desc')->get();


        $perPage = Request::input('perPage') ?: 5;

        $group_id = 0;
   
        $group_id = Group::where('academic_session_id', Request::input('academicSession') ?: $academicSession[0]->id)
            ->where('name', 'like', Request::input('group') ?: 'Group-1')->first();
        // dd($group_id ? $group_id->id : 0);

        return Inertia::render('Admin/Certificate/Index', [
            'students' => Student::query()
            ->when(Request::input('isProject'), function ($query,$isProject)  {
                $query->where('isProject', $isProject);
            })
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
            'filters' => Request::only(['search', 'perPage', 'group', 'academicSession']),
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd("hello edit");

        // TODO check if the student have grade filled else grade is n't completed
        // check academic session which 
        // if in get null or zero for result then the return not yet else prepare per academic session and 
        // courses
        $students =  Student::where('students.id', $id)
            ->leftJoin('grades', 'grades.student_id', '=', 'students.id')
            // ->Join('courses', 'grades.course_id', 'courses.id')
             ->select('students.id','isProject','score')
            ->get();
     

        if($students[0]->isProject){
            //  dd($students[0]);

            // find student project and check it progress
            $StuProj =ProjectStudent::where('student_id',$students[0]->id)->with('project')->first();
            if($StuProj->project->isProjectActive){
            return Redirect::back()->with('flash.banner', 'student didn\'t has incomplete his project')->with('flash.bannerStyle', 'danger');

            }
        }
     

        foreach($students as $st){
            if($st->score == 0 and $st->isProject == 0){
            return Redirect::back()->with('flash.banner', 'student didn\'t has incomplete grade')->with('flash.bannerStyle', 'danger');
            }
        }

        $pdf = PDF::loadView('Certificate');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('attendance.pdf');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
