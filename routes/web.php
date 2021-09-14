<?php

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

// Group routes to go through auth & verified middlewares
Route::middleware(['auth', 'verified'])->group(function (){
    // Home
    Route::get('/', 'App\Http\Controllers\UserController@home')->name('home');

    // Resume
    Route::get('/resume/new/view', 'App\Http\Controllers\ResumeController@create')->name('resume.view-new-resume');
    Route::post('/resume/new/create', 'App\Http\Controllers\ResumeController@store')->name('resume.create-new-resume');
    Route::get('/resume/edit/{resume}', 'App\Http\Controllers\ResumeController@edit')->name('resume.view-edit-resume');
    Route::post('/resume/{resume}/status', 'App\Http\Controllers\ResumeController@update')->name('resume.update-resume-status');
    Route::post('/resume/{resume}/delete', 'App\Http\Controllers\ResumeController@destroy')->name('resume.delete');

    // Edit profile page
    Route::view('/profile/edit', 'profile.edit-profile')->name('profile.edit');

    // Edit password page
    Route::view('/password/edit', 'profile.edit-password')->name('password.edit');

    // Resume Settings
    Route::get('/resume/edit/settings/{resume}', 'App\Http\Controllers\ResumeSettingsController@edit')->name('resume.view-edit-resume-settings');
    Route::post('/resume/{resume}/settings', 'App\Http\Controllers\ResumeSettingsController@update')->name('resume.update-resume-settings');

    // Add New Job
    Route::post('/resume/add/job', 'App\Http\Controllers\ResumeController@addJob')->name('resume.add-job');

    // Edit Job
    Route::post('/resume/edit/job', 'App\Http\Controllers\ResumeController@editJob')->name('resume.edit-job');

    // Add New Education
    Route::post('/resume/add/education', 'App\Http\Controllers\ResumeController@addEducation')->name('resume.add-education');

    // Edit Education
    Route::post('/resume/edit/education', 'App\Http\Controllers\ResumeController@editEducation')->name('resume.edit-education');

    // Delete Job/Education
    Route::post('/resume/delete/job-education', 'App\Http\Controllers\ResumeController@deleteJobEducation')->name('resume.delete-job-education');

});

// Check username already exist
Route::get('/user/check-username', 'App\Http\Controllers\UserController@usernameExists')->name('user.check-username');

// Check username in profile already exist
Route::get('/user/check-username-profile', 'App\Http\Controllers\UserController@usernameExists')->name('user.check-username-profile');

// View Resume
Route::get('/resume/{user:username}/{resume}', 'App\Http\Controllers\ResumeController@show')->name('resume.view-resume');

// Preview Resume Template
Route::get('/preview/resume/{template}', 'App\Http\Controllers\ResumeController@previewResume')->name('resume.preview-resume');
