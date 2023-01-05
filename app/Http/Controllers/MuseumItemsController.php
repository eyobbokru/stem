<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\MuseumItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreMuseumItemsRequest;
use App\Http\Requests\UpdateMuseumItemsRequest;

class MuseumItemsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:museumItem list', ['only' => ['index', 'show']]);
    //     $this->middleware('can:museumItem create', ['only' => ['create', 'store']]);
    //     $this->middleware('can:museumItem edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('can:museumItem delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Museum/MuseumItem/Index', [
            'museumItems' => MuseumItems::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%");
                })

                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage']),

            'can' => [
                'show' => Auth::user()->can('museumItem list'),
                'create' => Auth::user()->can('museumItem create'),
                'edit' => Auth::user()->can('museumItem edit'),
                'delete' => Auth::user()->can('museumItem delete'),
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
        return Inertia::render('Museum/MuseumItem/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMuseumItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMuseumItemsRequest $request)
    {
        $museumItem = new MuseumItems();
        $museumItem->name = $request->input('name');
        $museumItem->description = $request->input('description');

        if ($request->hasFile('imagePath')) {
            $file = $request->file('imagePath');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);
            $museumItem->imagePath = $filename;
        } else {
            $museumItem->imagePath = Null;
        }

        $museumItem->save();

        return Redirect::route('stem.museumItems.index')->with('flash.banner', 'News Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MuseumItems  $museumItems
     * @return \Illuminate\Http\Response
     */
    public function show(MuseumItems $museumItems)
    {
        return Inertia::render('Museum/MuseumItem/Show', [
            'museumItems' => $museumItems
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MuseumItems  $museumItems
     * @return \Illuminate\Http\Response
     */
    public function edit(MuseumItems $museumItems)
    {
        return Inertia::render('Museum/MuseumItem/Edit', [
            'museumItems' => $museumItems,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMuseumItemsRequest  $request
     * @param  \App\Models\MuseumItems  $museumItems
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMuseumItemsRequest $request, MuseumItems $museumItems)
    {

        $museumItems->title = $request->input('name');
        $museumItems->description = $request->input('description');

        if ($request->hasFile('imagePath')) {
            $path = public_path() . '/public/Image/';

            if ($museumItems->imagePath) {
                $file_old = $path . $museumItems->imagePath;
                unlink($file_old);
            }

            $file = $request->file('imagePath');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);
            $museumItems->imagePath = $filename;
        }

        $museumItems->save();


        return Redirect::route('stem.museumItems.index')->with('flash.banner', 'News Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MuseumItems  $museumItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(MuseumItems $museumItems)
    {
        //
    }
}
