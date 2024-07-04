<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployersController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\JobApplicationsController;
use App\Http\Controllers\MyJobApplicationsController;
use App\Http\Controllers\MyJobsController;

Route::get('/', fn() => to_route('jobs.index'));

Route::resource('jobs', JobsController::class)
    ->only(['index', 'show']);

Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);

Route::get('login', fn() => to_route('auth.create'))->name('login');


Route::delete('logout', fn() => to_route('auth.destroy'))->name('logout');

Route::delete('auth', [AuthController::class, 'destroy'])->name('auth.destroy');

Route::middleware('auth')->group(function() {

    Route::resource('job.application', JobApplicationsController::class)
    ->only(['create', 'store']);

    Route::resource('my-job-applications', MyJobApplicationsController::class)
        ->only(['index', 'destroy']);

    Route::resource('employer', EmployersController::class)
        ->only(['create', 'store']);

    Route::middleware('employer')->resource('my-jobs', MyJobsController::class);    

});