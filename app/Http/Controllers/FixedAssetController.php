<?php

namespace App\Http\Controllers;

use App\Models\FixedAsset;
use App\Http\Requests\StoreFixedAssetRequest;
use App\Http\Requests\UpdateFixedAssetRequest;

class FixedAssetController extends Controller
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
     * @param  \App\Http\Requests\StoreFixedAssetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFixedAssetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FixedAsset  $fixedAsset
     * @return \Illuminate\Http\Response
     */
    public function show(FixedAsset $fixedAsset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FixedAsset  $fixedAsset
     * @return \Illuminate\Http\Response
     */
    public function edit(FixedAsset $fixedAsset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFixedAssetRequest  $request
     * @param  \App\Models\FixedAsset  $fixedAsset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFixedAssetRequest $request, FixedAsset $fixedAsset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FixedAsset  $fixedAsset
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixedAsset $fixedAsset)
    {
        //
    }
}
