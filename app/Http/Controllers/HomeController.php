<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $currentDate = Carbon::now();

        $news = News::latest()->paginate(3);
        $calls = Call::whereDate('end_date','>', $currentDate)->latest()->paginate(3);
        // dd($news);
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'allNews' => $news,
            'allCalls' => $calls,
        ]);
    }


    public function dashboard()
    {

        return Inertia::render('Dashboard');

    }

    // new show 
    public function news($id)
    {
        $news = News::findOrFail($id);
    

        return Inertia::render('News',[
            'news'=>$news,
         
        ]);

    }
    //call show 
    public function calls($id)
    {
        $calls = Call::findOrFail($id);
    

        return Inertia::render('Calls',[
            'calls'=>$calls,
         
        ]);

    }
    // call apply
}
