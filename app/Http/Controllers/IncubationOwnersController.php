<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncubationOwnersRequest;
use App\Http\Requests\UpdateIncubationOwnersRequest;
use App\Models\IncubationOwners;

class IncubationOwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreIncubationOwnersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncubationOwnersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncubationOwners  $incubationOwners
     * @return \Illuminate\Http\Response
     */
    public function show(IncubationOwners $incubationOwners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncubationOwners  $incubationOwners
     * @return \Illuminate\Http\Response
     */
    public function edit(IncubationOwners $incubationOwners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncubationOwnersRequest  $request
     * @param  \App\Models\IncubationOwners  $incubationOwners
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncubationOwnersRequest $request, IncubationOwners $incubationOwners)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncubationOwners  $incubationOwners
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncubationOwners $incubationOwners)
    {
        //
    }
}
