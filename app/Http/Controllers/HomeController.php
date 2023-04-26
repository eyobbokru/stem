<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\News;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;


class HomeController extends Controller
{
    public function home()
    {

        $news = News::latest()->paginate(3);
        $news = Call::latest()->paginate(3);
        // dd($news);
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'allNews' => $news,
        ]);
    }


    public function dashboard()
    {

        return Inertia::render('Dashboard');

    }

    // new show 
    public function news()
    {

        return Inertia::render('Dashboard');

    }
    //call show 

    // call apply
}
