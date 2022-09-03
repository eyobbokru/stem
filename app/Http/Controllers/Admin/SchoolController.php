<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\School;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/School/Index', [
            'schools' => School::query()
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
        return Inertia::render('Admin/School/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSchoolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolRequest $request)
    {
        School::create([
            'name' => Request::input('name'),
            'address' => Request::input('address'),
            'phone' => Request::input('phone'),
            'level' => Request::input('level'),
        ]);

        return Redirect::route('admin.school.index')->with('flash.banner', 'School Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return Inertia::render('Admin/School/Edit', [
            'school' => $school,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchoolRequest  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update([
            'name' => Request::input('name'),
            'address' => Request::input('address'),
            'phone' => Request::input('phone'),
            'level' => Request::input('level'),
        ]);

        return Redirect::route('admin.school.index')->with('flash.banner', 'School updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return Redirect::route('admin.school.index')->with('flash.banner', 'School deleted.')->with('flash.bannerStyle', 'danger');
    }
}
