<?php

namespace App\Http\Controllers;

use App\Models\News;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreNewsRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdateNewsRequest;
use Illuminate\Support\Facades\Redirect;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = Request::input('perPage') ?: 5;
        return Inertia::render('Admin/News/Index', [
            'news' => News::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%");
                })

                ->paginate($perPage)
                ->withQueryString(),
            'filters' => Request::only(['search', 'perPage']),

            'can' => [
                'show' => Auth::user()->can('museum list'),
                'create' => Auth::user()->can('museum create'),
                'edit' => Auth::user()->can('museum edit'),
                'delete' => Auth::user()->can('museum delete'),
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
        return Inertia::render('Admin/News/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        $news = new News();
        $news->title = $request->input('title');
        $news->description = $request->input('description');

        if ($request->hasFile('imagePath')) {
            $file = $request->file('imagePath');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);
            $news->imagePath = $filename;
        } else {
            $news->imagePath = Null;
        }

        $news->save();

        return Redirect::route('stem.news.index')->with('flash.banner', 'News Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {

        return Inertia::render('Admin/News/Show', [
            'news' => $news
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return Inertia::render('Admin/News/Edit', ['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {


        $news->title = $request->input('title');
        $news->description = $request->input('description');

        if ($request->hasFile('imagePath')) {
            $path = public_path() . '/public/Image/';

            if ($news->imagePath) {
                $file_old = $path . $news->imagePath;
                unlink($file_old);
            }

            $file = $request->file('imagePath');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);
            $news->imagePath = $filename;
        }

        $news->save();


        return Redirect::route('stem.news.index')->with('flash.banner', 'News Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
