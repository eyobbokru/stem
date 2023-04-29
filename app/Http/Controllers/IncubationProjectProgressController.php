<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreIncubationProjectProgressRequest;
use App\Http\Requests\UpdateIncubationProjectProgressRequest;
use App\Models\Incubation;
use App\Models\IncubationProjectProgress;

class IncubationProjectProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/IncubationProjectProgress/Index', [
            'incubations' => Incubation::query()
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncubationProjectProgressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncubationProjectProgressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncubationProjectProgress  $incubationProjectProgress
     * @return \Illuminate\Http\Response
     */
    public function show(IncubationProjectProgress $incubationProjectProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncubationProjectProgress  $incubationProjectProgress
     * @return \Illuminate\Http\Response
     */
    public function edit(IncubationProjectProgress $incubationProjectProgress,$id)
    {
        $incubation = Incubation::findOrFail($id);

        
       
        return Inertia::render('Admin/IncubationProjectProgress/Edit', [
             'incubation' => $incubation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncubationProjectProgressRequest  $request
     * @param  \App\Models\IncubationProjectProgress  $incubationProjectProgress
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //    dd(Request::hasFile('image_video'));
        // dd(Request::all());
        
         $incubation = Incubation::findOrFail($id);
         $filePath = Null;
 
         $progress = new IncubationProjectProgress();
         $progress->progressReport = Request::input('progressReport');
         $progress->incubation_id = $incubation->id;
 
 
         // store the file
         if (Request::hasFile('image_video')) {
             $file = Request::file('image_video');
             $filename = date('YmdHi') . $file->getClientOriginalName();
             $file->move(public_path('public/files'), $filename);
 
             $progress->image_video = Request::file('image_video')->store('files/' .$filename, 'public');


  
         } else {
             $progress->image_video = Null;
         }

 
         $progress->save();
 
         return Redirect::route('admin.incProProgress.index')->with('flash.banner', 'Progress add successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncubationProjectProgress  $incubationProjectProgress
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncubationProjectProgress $incubationProjectProgress)
    {
        //
    }
}
