<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabEquipmentRequest;
use App\Http\Requests\UpdateLabEquipmentRequest;
use App\Models\LabEquipment;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class LabEquipmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:lab_equipment list', ['only' => ['index', 'show']]);
        $this->middleware('can:lab_equipment create', ['only' => ['create', 'store']]);
        $this->middleware('can:lab_equipment edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:lab_equipment delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/LabEquipment/Index', [
            'labEquipments' => LabEquipment::query()
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
        return Inertia::render('Admin/LabEquipment/Create', []);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLabEquipmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabEquipmentRequest $request)
    {
     
        LabEquipment::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'quantity' => $request->input('quantity'),
            'si_unit' => $request->input('si_unit'),
        ]);
        return Redirect::route('admin.labEquipment.index')->with('flash.banner', 'lab Equipment Created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LabEquipment  $labEquipment
     * @return \Illuminate\Http\Response
     */
    public function show(LabEquipment $labEquipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LabEquipment  $labEquipment
     * @return \Illuminate\Http\Response
     */
    public function edit(LabEquipment $labEquipment)
    {
        return Inertia::render('Admin/LabEquipment/Edit', [
            'labEquipment' => $labEquipment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLabEquipmentRequest  $request
     * @param  \App\Models\LabEquipment  $labEquipment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLabEquipmentRequest $request, LabEquipment $labEquipment)
    {
        $labEquipment->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'quantity' => $request->input('quantity'),
            'si_unit' => $request->input('si_unit'),
        ]);

        return Redirect::route('admin.labEquipment.index')->with('flash.banner', 'Lab Equipment updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LabEquipment  $labEquipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabEquipment $labEquipment)
    {
        $labEquipment->delete();
        return Redirect::route('admin.labEquipment.index')->with('flash.banner', 'labEquipment deleted.')->with('flash.bannerStyle', 'danger');

    }
}
