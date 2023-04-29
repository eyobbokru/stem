<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Project;
use App\Models\Student;
use App\Models\ProjectStudent;
use App\Models\AcademicSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('can:project list', ['only' => ['index', 'show']]);
    //     $this->middleware('can:project create', ['only' => ['create', 'store']]);
    //     $this->middleware('can:project edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('can:project delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/Project/Index', [
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
        // get current active academic session
        $academicSession = AcademicSession::where('active', '=', 1)->pluck('id')[0]; // first

        $studentProject = ProjectStudent::pluck('student_id')->toArray();
        // get project students that aren't grouped
        $students = Student::where('academic_session_id', $academicSession) //project students
            ->WhereNotIn('id', $studentProject)
            ->where('isProject', 1)
            ->get();
        // dd($students);

        return Inertia::render(
            'Admin/Project/Create',
            ['students' => $students]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(Request::all());
        $academic_Session = AcademicSession::where('active', '=', 1)->pluck('id')[0]; // first

        // dd($academic_Session);
        $requestValidated =  Request::validate([
            'name' => 'required',
            'description' => 'required',
             
        ]);

        $project = Project::create(
            
            [
                'name' => Request::input('name') ,
                'description' => Request::input('description') ,
                'academic_session_id'=>$academic_Session,
                'isProjectActive'=>0,
            ]
        );

        // project students
        foreach (Request::input('studentGroup') as $students) {
            ProjectStudent::create([
                'project_id' => $project->id,
                'student_id' => $students['id']
            ]);
        }

        return Redirect::route('admin.project.index')->with('flash.banner', 'Project Created successfully');

        // dd(Request::input());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $academicSession = AcademicSession::where('active', '=', 1)->pluck('id')[0]; // first

        $studentProject = ProjectStudent::where('project_id', '<>', $project->id)->pluck('student_id')->toArray();

        // dd($studentProject);
        // get project students that aren't grouped
        $students = Student::where('academic_session_id', $academicSession) //project students
            ->WhereNotIn('id', $studentProject)
            ->where('isProject', 1)
            ->get();

        //TODO THIS IS NOT DONE
        return Inertia::render(
            'Admin/Project/Show',
            [
                'students' => $students,
                'project' => $project,
                // 'SelectedStudents' => $SStudents
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        // dd($project);
        // get current active academic session
        $academicSession = AcademicSession::where('active', '=', 1)->pluck('id')[0]; // first

        $studentProject = ProjectStudent::where('project_id', '<>', $project->id)->pluck('student_id')->toArray();

        // dd($studentProject);
        // get project students that aren't grouped
        $students = Student::where('academic_session_id', $academicSession) //project students
            ->WhereNotIn('id', $studentProject)
            ->where('isProject', 1)
            ->get();

        // get selected students
        // $student =  $students->push($project->students->except('laravel_through_key'));

        // dd($student);

        return Inertia::render(
            'Admin/Project/Edit',
            [
                'students' => $students,
                'project' => $project,
                // 'SelectedStudents' => $SStudents
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // dd($project);
        $requestValidated =  Request::validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $project->update($requestValidated);

        ProjectStudent::where('project_id', $project->id)->delete();
        // project students
        foreach (Request::input('studentGroup') as $students) {
            ProjectStudent::create([
                'project_id' => $project->id,
                'student_id' => $students['id']
            ]);
        }

        return Redirect::route('admin.project.index')->with('flash.banner', 'project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return Redirect::route('admin.project.index')->with('flash.banner', 'project deleted.')->with('flash.bannerStyle', 'danger');
    }
}
