<?php


use App\Models\News;
use Inertia\Inertia;
use App\Models\GradeStudent;

use App\Models\AcademicSession;
use App\Models\ProjectProgress;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\LabController;
use App\Http\Controllers\Admin\CallController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\MuseumItemsController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Museum\MuseumController;
use App\Http\Controllers\ProjectProgressController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\GradeReportController;
use App\Http\Controllers\Admin\PdfGenerateController;
use App\Http\Controllers\Admin\GradeStudentController;
use App\Http\Controllers\Admin\AcademicSessionController;
use App\Http\Controllers\IncubationController;
use App\Http\Controllers\IncubationProjectProgressController;
use App\Models\Incubation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/news/{id}', [HomeController::class, 'news'])->name('news.show');
Route::get('/calls/{id}', [HomeController::class, 'calls'])->name('calls.show');

// Route::get('/', function () {

//     $news = News::latest()->paginate(3);
//     // dd($news);
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//         'allNews' => $news,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    // 'role:admin'
])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/school', SchoolController::class);
    Route::resource('/teacher', TeacherController::class);
    Route::resource('/course', CourseController::class);
    Route::resource('/gradeStudent', GradeStudentController::class);
    Route::resource('/lab', LabController::class);
    Route::resource('/academicSession', AcademicSessionController::class);
    Route::resource('/student', StudentController::class);
    Route::resource('/management', ManagementController::class);
    Route::resource('/gradeReport', GradeReportController::class);
    Route::resource('/grade', GradeController::class);
    Route::resource('/certificates', CertificateController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/project', ProjectController::class);
    Route::resource('/projectProgress', ProjectProgressController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/calls', CallController::class);

    Route::resource('/incubation', IncubationController::class);
    Route::resource('/incProProgress', IncubationProjectProgressController::class);

    Route::get('/attendance', [PdfGenerateController::class, 'attendance'])->name('attendance');
    Route::get('/grades', [GradeController::class, 'grade'])->name('grades');

    Route::get('/academicSession/setActive/{id}', [AcademicSessionController::class, 'setActive'])->name('setActive');

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    // 'role:admin'
])->prefix('stem')->name('stem.')->group(function () {

    Route::resource('/museum', MuseumController::class);
    Route::resource('/museumItems', MuseumItemsController::class);
    Route::resource('/news', NewsController::class);
});

// outside
Route::get('/museum', function () {
    return Inertia::render('General/museumIndex');
})->name('museum');
