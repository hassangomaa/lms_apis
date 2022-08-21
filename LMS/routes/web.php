<?php

use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use App\Http\Controllers\AdminController;
 use App\Http\Controllers\StudentController;
 use App\Http\Controllers\CoursesController;
 use App\Http\Controllers\StaffController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function () {//NewDesign
    return view('admin1', [
        'admins' => Admin::Paginate(5)
    ]);
});


Route::get('/dashboard', function () {
   return view('Maindashboard/index');
   // return \File::get(public_path() . '/SPAindex.html');

 })->middleware(['auth'])->name('dashboard');


// admin CRUD
     //closure function
//    Route::get('/admins', [AdminController::class, 'index'])->name('Admins')->middleware('auth');
//    Route::get('/admins/create', [AdminController::class, 'create'])->name('Admins.create')->middleware('auth');
//    Route::get('/admins/edit/{admin}', [AdminController::class, 'edit'])->name('Admins.edit')->middleware('auth');
//    Route::post('/admins/update/{id}', [AdminController::class, 'update'])->name('Admins.update')->middleware('auth');
//    Route::post('/admins/destroy/{id}', [AdminController::class, 'destroy'])->name('Admins.destroy')->middleware('auth');
//    Route::post('/admins/create', [AdminController::class, 'store'])->name('Admins.store')->middleware('auth');



// admin CRUD
Route::middleware('auth')->group(function (){   //closure functionRoute::get('/admins', [AdminController::class, 'index'])->name('Admins')
    Route::get('/admins', [AdminController::class, 'index'])->name('Admins');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('Admins.create');
    Route::get('/admins/edit/{admin}', [AdminController::class, 'edit'])->name('Admins.edit');
    Route::post('/admins/update/{id}', [AdminController::class, 'update'])->name('Admins.update');
    Route::post('/admins/destroy/{id}', [AdminController::class, 'destroy'])->name('Admins.destroy');
    Route::post('/admins/store', [AdminController::class, 'store'])->name('Admins.store');

});


// Student CRUD
Route::middleware('auth')->group(function (){

    Route::get('/students', [StudentController::class, 'index'])->name('Students');
    Route::get('/students/create', [StudentController::class, 'create'])->name('Students.create');
    Route::get('/students/edit/{student}', [StudentController::class, 'edit'])->name('Students.edit');
    Route::post('/students/update/{id}', [StudentController::class, 'update'])->name('Students.update');
    Route::post('/students/destroy/{id}', [StudentController::class, 'destroy'])->name('Students.destroy');
    Route::post('/students/create', [StudentController::class, 'store'])->name('Students.store');

});

// Staff CRUD
Route::middleware('auth')->group(function (){

    Route::get('/staffs', [StaffController::class, 'index'])->name('Staffs');
    Route::get('/staffs/create', [StaffController::class, 'create'])->name('Staffs.create');
    Route::get('/staffs/edit/{student}', [StaffController::class, 'edit'])->name('Staffs.edit');
    Route::post('/staffs/update/{id}', [StaffController::class, 'update'])->name('Staffs.update');
    Route::post('/staffs/destroy/{id}', [StaffController::class, 'destroy'])->name('Staffs.destroy');
    Route::post('/staffs/create', [StaffController::class, 'store'])->name('Staffs.store');

});

// course CRUD
Route::middleware('auth')->group(function (){

    Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
    Route::get('/courses/create', [CoursesController::class, 'create'])->name('courses.create');
    Route::get  ('/courses/edit/{course}', [CoursesController::class, 'edit'])->name('courses.edit');
    Route::post('/courses/update/{id}', [CoursesController::class, 'update'])->name('courses.update');
    Route::post('/courses/destroy/{id}', [CoursesController::class, 'destroy'])->name('courses.destroy');
    Route::post('/courses/create', [CoursesController::class, 'store'])->name('courses.store');

});

require __DIR__.'/auth.php';
