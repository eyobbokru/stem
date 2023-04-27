<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\CoE;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users list', ['only' => ['index', 'show']]);
        $this->middleware('can:users create', ['only' => ['create', 'store']]);
        $this->middleware('can:users edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:users delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/User/Index', [
            'users' => User::query()
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
        $roles = Role::all();
        $coes = CoE::all();
        return Inertia::render('Admin/User/Create', [
            'roles'=>$roles,
            'coes'=>$coes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Request::validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $password = Hash::make('password');
        $office_id = null;
        // assumes that the role id coe will always be 4

        if(Request::input('role') == 4) {
            $office_id =Request::input('office_id');
        }

       $user =  User::create([
            'name' => Request::input('name'),
            'email' => Request::input('email'),
            'password' =>$password,
            'office_id' =>$office_id
        ]);

        if(Request::input('role')){

            $role  = Role::findOrFail(Request::input('role'));
            $user->assignRole($role->name);

        }
        return Redirect::route('admin.users.index')->with('flash.banner', 'User Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        
        $user = User::where('id',$id)->with('roles')->first();
        $roles = Role::all();
        $coes = CoE::all();
    
        return Inertia::render('Admin/User/Edit', [
            'user' => $user,
            'roles'=>$roles,
            'coes'=>$coes
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
        $user = User::findOrFail($id);

        Request::validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $office_id = $user->office_id;

        if(Request::input('role') == 4) {
            $office_id =Request::input('office_id');
        }

        $user->update([
            'name' => Request::input('name'),
            'email' => Request::input('email'),
            'office_id' => $office_id,

        ]);

        if(Request::input('role')){
            // remove roles 
            $user->syncRoles([]);
            
            $role  = Role::findOrFail(Request::input('role'));
            $user->assignRole($role->name);

        }

        return Redirect::route('admin.users.index')->with('flash.banner', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return Redirect::route('admin.users.index')->with('flash.banner', 'User deleted.')->with('flash.bannerStyle', 'danger');
    }



}
