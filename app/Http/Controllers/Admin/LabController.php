<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Http\Requests\StoreLabRequest;
use App\Http\Requests\UpdateLabRequest;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LabController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:lab list', ['only' => ['index', 'show']]);
        $this->middleware('can:lab create', ['only' => ['create', 'store']]);
        $this->middleware('can:lab edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:lab delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/Lab/Index', [
            'labs' => Lab::query()
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
        return Inertia::render('Admin/Lab/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLabRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabRequest $request)
    {
        Lab::create([
            'name' => Request::input('name'),
            'address' => Request::input('address'),
            'department' => Request::input('department'),
        ]);
        return Redirect::route('admin.lab.index')->with('flash.banner', 'Lab Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        return Inertia::render('Admin/Lab/Edit', [
            'lab' => $lab,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLabRequest  $request
     * @param  \App\Models\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLabRequest $request, Lab $lab)
    {
        $lab->update([
            'name' => Request::input('name'),
            'address' => Request::input('address'),
            'department' => Request::input('department'),
        ]);
        return Redirect::route('admin.lab.index')->with('flash.banner', 'Lab updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {

        $lab->delete();
        return Redirect::route('admin.lab.index')->with('flash.banner', 'Lab deleted.')->with('flash.bannerStyle', 'danger');
    }
}
