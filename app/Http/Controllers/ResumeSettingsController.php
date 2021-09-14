<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\EducationAchievement;
use App\Models\Job;
use App\Models\JobTask;
use App\Models\JobAchievement;
use App\Models\Resume;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResumeSettingsController extends Controller
{
    public function edit(Resume $resume) {
        if($resume->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('resume.create-new-resume', [
            'resume' => $resume,
            'templates' => Template::all()
        ]);
    }

    public function update(Resume $resume, Request $request) {
        $resume->update([
            'title' => $request->title,
            'template_id' => $request->template
        ]);        

        return redirect()->route('resume.view-edit-resume', $resume->id)->with('success', "Resume {$resume->title} has been updated.");
    }
}
