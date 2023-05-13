<?php

namespace App\Http\Controllers;



use App\Models\Lab;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\EquipmentStatus;
// use Illuminate\Support\Facades\Request;
use App\Models\LaboratoryEquipment;
use Illuminate\Support\Facades\Redirect;

class LabEquipmentStatus extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:lab_equipment_status list', ['only' => ['index', 'show']]);
    //     $this->middleware('can:lab_equipment_status create', ['only' => ['create', 'store']]);
    //     $this->middleware('can:lab_equipment_status edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('can:lab_equipment_status delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // find lab
        $lab = Lab::find(2);
        // find it equipments
       
        $perPage = $request->input('perPage') ?: 5;
        return Inertia::render('Admin/LabEquipmentStatus/Index', [
            'labEquipments' => LaboratoryEquipment::query()
            ->with('equipment')
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('lab_equipment.name', 'like', "%{$search}%");
                })
                ->where('lab_id',$lab->id)
                
                ->latest()
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => $request->only(['search', 'perPage'])
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
        // $lab = Lab::findOrFail($id);

        // list equipments filter
        $labEquipment = LaboratoryEquipment::with('equipment')->with('reportStatus')->findOrFail($id);

        // dd($labEquipment);

        return Inertia::render('Admin/LabEquipmentStatus/Edit', [
             'labEquipment' => $labEquipment,
          
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
    
// dd($request->all());
      $labEquipment = LaboratoryEquipment::with('equipment')->with('reportStatus')->findOrFail($id);


      if($request->type == 'decrease'){
        
        $labEquipment->update(['number'=>  $labEquipment->number - $request->number]);
      }

      if($request->type == 'increase'){
        
        $labEquipment->update(['number'=>  $labEquipment->number + $request->number]);

      }
      //EquipmentStatus
        EquipmentStatus::create($request->only('laboratory_equipment_id','description','status','number'));
      // Laboratory equipment and add
      // check if item exist in the with lab_id,
    
  
    //   LaboratoryEquipment::create(Request::only('lab_id','lab_equipment_id','quantity','number'));
  
      return Redirect::route('admin.equipmentStatus.index')->with('flash.banner', 'equipment report status add successfully');

    }

}
