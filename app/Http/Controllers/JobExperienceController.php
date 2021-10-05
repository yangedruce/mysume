<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobTask;
use App\Models\JobAchievement;
use Illuminate\Http\Request;

class JobExperienceController extends Controller
{
    protected $rules = [
        'resume_id' => 'required',
        'company_name' => 'required',
        'title' => 'required',
        'location' => 'required',
        'start_month' => 'required',
        'start_year' => 'required',
        'end_month' => 'required_without:currently_work',
        'end_year' => 'required_without:currently_work',
        'currently_work' => 'nullable',
        'task.*' => 'nullable',
        'job_achievement.*' => 'nullable'
    ];
    
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate($this->rules);
        
        $job = Job::create([
            'resume_id' => $request->resume_id,
            'company_name' => $request->company_name,
            'title' => $request->title,
            'location' => $request->location,
            'start_month' => $request->start_month,
            'start_year' => $request->start_year,
            'end_month' => $request->end_month,
            'end_year' => $request->end_year,
            'currently_work' => $request->has('currently_work')
        ]);

        foreach ($request->get('task') as $task) {
            $job->tasks()->create([
                'task_name' => $task
            ]);
        }

        foreach ($request->get('job_achievement') as $achievement) {
            $job->achievements()->create([
                'achievement_name' => $achievement
            ]);
        }

        return redirect()->route('resume.view-edit-resume', $job->resume_id)
            ->with('success', 'Job has been added.');
    }

    public function update(Request $request)
    {
        $request->validate($this->rules);

        $job = Job::where('id', $request->job_id)->first();

        $job->update([
            'company_name' => $request->company_name,
            'title' => $request->title,
            'location' => $request->location,
            'start_month' => $request->start_month,
            'start_year' => $request->start_year,
            'end_month' => $request->end_month,
            'end_year' => $request->end_year,
            'currently_work' => $request->has('currently_work')
        ]);

        foreach ($request->get('task') as $task) {
            $job->tasks()->update([
                'task_name' => $task
            ]);
        }

        $job->tasks()->delete();

        foreach ($request->get('job_achievement') as $achievement) {
            $job->achievements()->update([
                'achievement_name' => $achievement
            ]);
        }

        $job->achievements()->delete();
    
        return redirect()->route('resume.view-edit-resume', $job->resume_id)
            ->with('success', 'Job ' . $request->company_name . ' has been updated.');
    }

    public function destroy(Request $request)
    {
        Job::where('id', $request->id)->where('resume_id', $request->resume_id)->first()->delete();
           
        JobTask::where('job_id', $request->job_id)->get()->tasks()->each->delete();

        JobAchievement::where('job_id', $request->job_id)->get()->achievements()->each->delete();

        return redirect()->route('resume.view-edit-resume', $request->resume_id)->with('success', $request->company_name.' has been deleted.');
    }
}
