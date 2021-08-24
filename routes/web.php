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
    // Home page
    Route::get('/', 'App\Http\Controllers\UserController@home')->name('home');

    // Edit profile page
    Route::view('/profile/edit', 'profile.edit-profile')->name('profile.edit');

    // Upload profile picture
    Route::post('/profile/upload', 'App\Http\Controllers\UserController@uploadProfilePicture')->name('profile.upload');

    // Check username in profile already exist
    Route::get('/user/check-username-profile', 'App\Http\Controllers\UserController@checkUsernameProfile')->name('user.check-username-profile');

    // Edit password page
    Route::view('/password/edit', 'profile.edit-password')->name('password.edit');

    // View New Resume
    Route::get('/resume/new/view', 'App\Http\Controllers\ResumeController@viewNewResume')->name('resume.view-new-resume');

    // Create New Resume
    Route::post('/resume/new/create', 'App\Http\Controllers\ResumeController@createNewResume')->name('resume.create-new-resume');

    // Delete Resume
    Route::post('/resume/delete', 'App\Http\Controllers\ResumeController@deleteResume')->name('resume.delete');

    // View Edit Resume
    Route::get('/resume/edit/{resume_id}', 'App\Http\Controllers\ResumeController@viewEditResume')->name('resume.view-edit-resume');

    // View Edit Resume - Settings
    Route::get('/resume/edit/settings/{resume_id}', 'App\Http\Controllers\ResumeController@viewEditResumeSettings')->name('resume.view-edit-resume-settings');

    // Update Resume - Settings
    Route::post('/resume/update/settings', 'App\Http\Controllers\ResumeController@updateResumeSettings')->name('resume.update-resume-settings');

    // Update Resume - Publish
    Route::post('/resume/update/status', 'App\Http\Controllers\ResumeController@updateResumeStatus')->name('resume.update-resume-status');

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
Route::get('/user/check-username', 'App\Http\Controllers\UserController@checkUsername')->name('user.check-username');

// View Resume
Route::get('/resume/{username}/{resume_id}', 'App\Http\Controllers\ResumeController@viewResume')->name('resume.view-resume');

// Preview Resume Template
Route::get('/preview/resume/{template}', 'App\Http\Controllers\ResumeController@previewResume')->name('resume.preview-resume');
