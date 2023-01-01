<?php

namespace App\Http\Controllers\Museum;

use Inertia\Inertia;
use App\Models\Museum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreMuseumRequest;
use App\Http\Requests\UpdateMuseumRequest;

class MuseumController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('can:museum list', ['only' => ['index', 'show']]);
    //     $this->middleware('can:museum create', ['only' => ['create', 'store']]);
    //     $this->middleware('can:museum edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('can:museum delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Museum/Index', [
            'museums' => Museum::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('from', 'like', "%{$search}%");
                })

                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage']),

            'can' => [
                'show' => Auth::user()->can('museum list'),
                'create' => Auth::user()->can('museum create'),
                'edit' => Auth::user()->can('museum edit'),
                'delete' => Auth::user()->can('museum delete'),
            ],


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Museum/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMuseumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMuseumRequest $request)
    {

        Museum::create([
            'from' => Request::input('from'),
            'numberOfStudents' => Request::input('numberOfStudents'),
            'remark' => Request::input('remark'),
        ]);

        return Redirect::route('stem.museum.index')->with('flash.banner', 'Museum Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function show(Museum $museum)
    {
        return Inertia::render('Museum/Show', [
            'museum' => $museum,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function edit(Museum $museum)
    {
        return Inertia::render('Museum/Edit', [
            'museum' => $museum,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMuseumRequest  $request
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMuseumRequest $request, Museum $museum)
    {
        $museum->update([
            'from' => Request::input('from'),
            'numberOfStudents' => Request::input('numberOfStudents'),
            'remark' => Request::input('remark'),
        ]);

        return Redirect::route('stem.museum.index')->with('flash.banner', 'Museum Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Museum  $museum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Museum $museum)
    {
        $museum->delete();
        return Redirect::route('stem.museum.index')->with('flash.banner', 'Museum Report deleted.')->with('flash.bannerStyle', 'danger');
    }
}
