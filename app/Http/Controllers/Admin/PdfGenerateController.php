<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Inertia\Inertia;
use App\Models\Group;
use App\Models\Student;

use App\Models\AcademicSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class PdfGenerateController extends Controller
{
    /**
     * Show the form for creating a new resource. 
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request     *    
     *  */
    public function attendance(Request $request)
    {

        if(Request::input('academicSession') == null){
            return Redirect::back()->with('flash.banner', 'please select Academic Session')->with('flash.bannerStyle', 'danger');
            }
        
        $academicSession1 = AcademicSession::where('id', Request::input('academicSession'))->with('section')->first();

        if($academicSession1->active == 0){
            return Redirect::back()->with('flash.banner', 'please select activate Academic Session, this is closed academic session')->with('flash.bannerStyle', 'danger');
            }

        $academicSession = AcademicSession::with('section')->orderBy('created_at', 'desc')->get();


        $perPage = Request::input('perPage') ?: 5;

        $group_id = 0;
        $group_id = Group::where('academic_session_id', Request::input('academicSession') ?: $academicSession[0]->id)
            ->where('name', 'like', Request::input('group') ?: 'Group-1')->first();
        // dd($group_id ? $group_id->id : 0);

        $student = Student::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when(Request::input('academicSession'), function ($query, $academicSession) {
                $query->where('academic_session_id', 'like', "%{$academicSession}%");
            })
            ->when(Request::input('group'), function ($query) use ($group_id) {
                $query->where('group_id', $group_id ? $group_id->id : 0);
            })->get();

        //  dd($student);
        if(count($student) == 0){

            return Redirect::back()->with('flash.banner', 'there is no students register in this session')->with('flash.bannerStyle', 'danger');;
               
            }
        // $pdf = PDF::loadView('attendaceReport')->setPaper('a4')->setWarnings(false);
        $pdf = PDF::loadView('attendaceReport', compact('student'))->setPaper('a4');

        return $pdf->download('attendance.pdf');

        return Redirect::route('admin.student.index')->with('flash.banner', 'Student Created successfully');
    }
}
