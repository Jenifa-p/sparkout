<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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
    return view('welcome');
});

Auth::routes();
// Routes for auth
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
    
});

// Routes for Admin and Project Manager
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admindashboard');
    Route::get('/projects/index', [ProjectController::class, 'index'])->name('projectindex');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projectcreate');
    Route::post('/projects/store', [ProjectController::class, 'store'])->name('projectstore');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projectedit');
    Route::get('/projects/{project}/view', [ProjectController::class, 'show'])->name('projectview');
    Route::put('/projects/update', [ProjectController::class, 'update'])->name('projectupdate');
    Route::delete('/projects/{project}/destroy', [ProjectController::class, 'destroy'])->name('projectdestroy');
    Route::get('/tasks/{project}/create', [TaskController::class, 'create'])->name('taskcreate');
    Route::post('/tasks/{project}/store', [TaskController::class, 'store'])->name('taskstore');
    Route::get('/tasks/{project}/{task}/edit', [TaskController::class, 'edit'])->name('taskedit');
    Route::put('/tasks/{project}/{task}/update', [TaskController::class, 'update'])->name('taskupdate');
    Route::delete('/tasks/{project}/{task}/destroy', [TaskController::class, 'destroy'])->name('taskdestroy');
    Route::patch('/projects/{project}/tasks/{task}/complete', [TaskController::class, 'markAsCompleted'])->name('markAsCompleted');
});

// Routes for Member
Route::group(['middleware' => ['auth', 'member']], function () {
    Route::get('/member/{user}/dashboard', [HomeController::class, 'memberDashboard'])->name('memberdashboard');
});