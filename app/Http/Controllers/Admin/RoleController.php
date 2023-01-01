<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:role list', ['only' => ['index', 'show']]);
        $this->middleware('can:role create', ['only' => ['create', 'store']]);
        $this->middleware('can:role edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:role delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/Role/Index', [
            'roles' => Role::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })

                ->paginate($perPage)
                ->withQueryString(),

            'filters' => Request::only(['search', 'perPage']),
            'can' => [
                'create' => Auth::user()->can('role create'),
                'edit' => Auth::user()->can('role edit'),
                'delete' => Auth::user()->can('role delete'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all()->pluck("name", "id");
        return Inertia::render('Admin/Role/Create', [
            'permissions' =>  $permissions
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
        ]);

        $role = Role::create([
            'guard_name' => 'web',
            'name' => Request::input('name'),
        ]);

        if (!empty(Request::input('permissions'))) {

            $role->givePermissionTo(Request::input('permissions'));
        }


        return Redirect::route('admin.role.index')->with('flash.banner', 'Role Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $permissions = Permission::all()->pluck("name", "id");
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');


        return Inertia::render('Admin/Role/Edit', [
            'role' => $role,
            'permissions' => $permissions,
            'roleHasPermissions' => $roleHasPermissions,

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

        $role = Role::findOrFail($id);
        Request::validate([
            'name' => 'required',
        ]);

        $role->update([
            'name' => Request::input('name'),
        ]);


        $permissions = Request::input('permissions') ?? [];
        $role->syncPermissions($permissions);


        return Redirect::route('admin.role.index')->with('flash.banner', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return Redirect::route('admin.role.index')->with('flash.banner', 'Role deleted.')->with('flash.bannerStyle', 'danger');
    }
}
