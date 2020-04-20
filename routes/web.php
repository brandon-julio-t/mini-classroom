<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::middleware('auth')->group(function () {

    Route::view('/', 'dashboard')->name('home');

    Route::post('classrooms/enroll', 'ClassroomController@enroll')
        ->name('classrooms.enroll');
    Route::delete('classrooms/unenroll/{classroom_id}', 'ClassroomController@unenroll')
        ->name('classrooms.unenroll');

    Route::get('assignments/all', 'AssignmentController@all')->name('assignments.all');

    Route::resources([
        'profile' => 'ProfileController',
        'classrooms' => 'ClassroomController',
        'classrooms.assignments' => 'AssignmentController',
        'assignments.submitted' => 'SubmittedAssignmentController'
    ]);

});

