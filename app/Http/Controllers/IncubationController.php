<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Http\Requests\StoreIncubationRequest;
use App\Http\Requests\UpdateIncubationRequest;
use App\Models\Incubation;
use App\Models\IncubationOwners;
use App\Models\IncubationProjectOwners;

class IncubationController extends Controller
{

        // public function __construct()
    // {
    //     $this->middleware('can:incubation list', ['only' => ['index', 'show']]);
    //     $this->middleware('can:incubation create', ['only' => ['create', 'store']]);
    //     $this->middleware('can:incubation edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('can:incubation delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/Incubation/Index', [
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
         
 
         return Inertia::render(
             'Admin/Incubation/Create',

         );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncubationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncubationRequest $request)
    {
        // dd($request->owners);

        // create incubation
        $incubation = Incubation::create(
            $request->only('name','description')
        );

        // create incubation owner
      foreach( $request->owners as $owner){

        $incubi = IncubationOwners::create([
            'name' =>$owner['name'],
            'middle_name'=>$owner['middle_name'],
            'last_name'=>$owner['last_name'],
            'phone'=>$owner['phone'],
            'email'=>$owner['email'],
        ]);

        IncubationProjectOwners::create([
            'incubation_id' => $incubation->id,
            'incubation_owners_id' =>$incubi->id ,
        ]);


      }
       
      return Redirect::route('admin.incubation.index')->with('flash.banner', 'Incubation Project Created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incubation  $incubation
     * @return \Illuminate\Http\Response
     */
    public function show(Incubation $incubation)
    {
        // dd($incubation->owners);
        $incubee = Incubation::where('id',$incubation->id)->with('owners')->first();
        
      

        return Inertia::render(
            'Admin/Incubation/Show',
            [
             'incubation'=>$incubee
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incubation  $incubation
     * @return \Illuminate\Http\Response
     */
    public function edit(Incubation $incubation)
    {
        // dd($incubation->owners);
        $incubee = Incubation::where('id',$incubation->id)->with('owners')->first();
        
      

        return Inertia::render(
            'Admin/Incubation/Edit',
            [
             'incubation'=>$incubee
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncubationRequest  $request
     * @param  \App\Models\Incubation  $incubation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncubationRequest $request, Incubation $incubation)
    {
        $incubation->update($request->only('name','description'));

        // go through all owners of the project
        // dd($request->owners);
        foreach( $request->owners as $owner){

           
            $ow = IncubationOwners::find($owner['id']);
            
            // dd($ow);
            if($ow){
                $ow->update(
                    [
                        'name' =>$owner['name'],
                        'middle_name'=>$owner['middle_name'],
                        'last_name'=>$owner['last_name'],
                        'phone'=>$owner['phone'],
                        'email'=>$owner['email'],
                    ]
                    );
            }else{
                $incubi = IncubationOwners::create([
                    'name' =>$owner['name'],
                    'middle_name'=>$owner['middle_name'],
                    'last_name'=>$owner['last_name'],
                    'phone'=>$owner['phone'],
                    'email'=>$owner['email'],
                ]);

                IncubationProjectOwners::create([
                    'incubation_id' => $incubation->id,
                    'incubation_owners_id' =>$incubi->id ,
                ]);
        
        
            }

        }

      return Redirect::route('admin.incubation.index')->with('flash.banner', 'Incubation Project Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incubation  $incubation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incubation $incubation)
    {
        $incubation->delete();
        return Redirect::route('admin.project.index')->with('flash.banner', 'incubation project deleted.')->with('flash.bannerStyle', 'danger');

    }
}
