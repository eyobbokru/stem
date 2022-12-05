<?php


use Inertia\Inertia;
use App\Models\GradeStudent;
use App\Models\AcademicSession;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Admin\LabController;
use App\Http\Controllers\Admin\GradeController;

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\CertificateController;

use App\Http\Controllers\Admin\GradeReportController;
use App\Http\Controllers\Admin\PdfGenerateController;
use App\Http\Controllers\Admin\GradeStudentController;
use App\Http\Controllers\Admin\AcademicSessionController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::middleware([
    'auth:sanctum',

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

    Route::get('/attendance', [PdfGenerateController::class, 'attendance'])->name('attendance');
    Route::get('/grades', [GradeController::class, 'grade'])->name('grades');
    // Route::get('/certificates', [CertificateController::class, 'grade'])->name('grades');
});
