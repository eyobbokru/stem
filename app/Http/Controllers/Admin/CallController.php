<?php

namespace App\Http\Controllers\Admin;

use App\Models\Call;
use Inertia\Inertia;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCallRequest;

use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateCallRequest;
use Illuminate\Support\Facades\Redirect;

class CallController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:calls list', ['only' => ['index', 'show']]);
        $this->middleware('can:calls create', ['only' => ['create', 'store']]);
        $this->middleware('can:calls edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:calls delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/Call/Index', [
            'calls' => Call::query()
                ->where('coes_id', Auth::user()->office_id)
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
        return Inertia::render('Admin/Call/Create', [
          
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCallRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCallRequest $request)
    {
        $call =  Call::create([
            'name' => $request->name,
            'end_date' =>  Carbon::parse($request->end_date),
            'coes_id' => Auth::user()->office_id
        ]);

        return Redirect::route('admin.calls.index')->with('flash.banner', 'Call Created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function show(Call $call)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function edit(Call $call)
    {
        return Inertia::render('Admin/Call/Edit', [
        'call' => $call
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCallRequest  $request
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCallRequest $request, Call $call)
    {
        $call->update([
            'name' => $request->name,
            'end_date' => Carbon::parse($request->end_date),
            'coes_id' => Auth::user()->office_id
        ]);

        return Redirect::route('admin.calls.index')->with('flash.banner', 'project call updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function destroy(Call $call)
    {
        $call->delete();
        return Redirect::route('admin.calls.index')->with('flash.banner', 'project call deleted.')->with('flash.bannerStyle', 'danger');

    }
}
