<?php

use App\Http\Controllers\Crm\Client\ClientController;
use App\Http\Controllers\Crm\HomeController;
use App\Http\Controllers\Crm\Project\ProjectController;
use App\Http\Controllers\Crm\Task\TaskController;
use App\Http\Controllers\Crm\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::permanentRedirect('/', 'crm');


Route::group(['prefix' => 'crm', 'middleware' => ['verified', 'auth']], function () {

    Route::get('/', HomeController::class)->name('crm.main.index');

    Route::resource('clients', ClientController::class, [
        'names' => [
            'index' => 'crm.client.index',
            'show' => 'crm.client.show',
            'create' => 'crm.client.create',
            'store' => 'crm.client.store',
            'edit' => 'crm.client.edit',
            'update' => 'crm.client.update',
            'destroy' => 'crm.client.destroy',
        ]
    ]);

    Route::resource('projects', ProjectController::class, [
        'names' => [
            'index' => 'crm.project.index',
            'show' => 'crm.project.show',
            'create' => 'crm.project.create',
            'store' => 'crm.project.store',
            'edit' => 'crm.project.edit',
            'update' => 'crm.project.update',
            'destroy' => 'crm.project.destroy',
        ]
    ]);

    Route::resource('tasks', TaskController::class, [
        'names' => [
            'index' => 'crm.task.index',
            'show' => 'crm.task.show',
            'create' => 'crm.task.create',
            'store' => 'crm.task.store',
            'edit' => 'crm.task.edit',
            'update' => 'crm.task.update',
            'destroy' => 'crm.task.destroy',
        ]
    ])->middleware('admin');

    Route::resource('users', UserController::class, [
        'names' => [
            'index' => 'crm.user.index',
            'show' => 'crm.user.show',
            'create' => 'crm.user.create',
            'store' => 'crm.user.store',
            'edit' => 'crm.user.edit',
            'update' => 'crm.user.update',
            'destroy' => 'crm.user.destroy',
        ]
    ])->middleware('admin');

});


Auth::routes(['verify' => true]);

