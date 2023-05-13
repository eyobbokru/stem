<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\LabEquipment;
use App\Models\LaboratoryEquipment;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class LaboratoryEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/LaboratoryAddEquipment/Index', [
            'labs' => Lab::query()
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
        #get lab with it equipment and show equipments

        $lab = Lab::with('equipments')->find($id);

        // dd($lab);

        return Inertia::render('Admin/LaboratoryAddEquipment/Show', [
            'lab' => $lab
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lab = Lab::findOrFail($id);

        // list equipments filter
        $equipments = LabEquipment::all();

           
        return Inertia::render('Admin/LaboratoryAddEquipment/Edit', [
             'lab' => $lab,
             'equipments'=>$equipments,
        ]);
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
    //   dd(Request::all());

      // Laboratory equipment and add
      // check if item exist in the with lab_id,
      $lab = Lab::with('equipments')->find($id);
    //   dd($lab);
// dd(Request::input('lab_equipment_id'));
    foreach($lab->equipments as $equipments){
            if($equipments->id == Request::input('lab_equipment_id')){

                // equipment already exists
            //    $labeq =  LaboratoryEquipment::where('lab_equipment_id',$equipments->id)->first();
            return Redirect::back()->with('flash.banner', 'equipment item already exists')->with('flash.bannerStyle', 'danger');;


            }
    }

    //   LaboratoryEquipment::create(Request::only('lab_id','lab_equipment_id','quantity','number'));
  
      return Redirect::route('admin.addEquipment.index')->with('flash.banner', 'equipment add successfully');

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
