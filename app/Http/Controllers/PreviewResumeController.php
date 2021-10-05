<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\EducationAchievement;
use App\Models\Job;
use App\Models\JobTask;
use App\Models\JobAchievement;
use App\Models\Resume;
use Illuminate\Http\Request;
use App\Models\User;

class PreviewResumeController extends Controller
{
    // Preview resume with dummy data
    public function show(Request $request, $template)
    {
        $user = User::make([
            'fullname' => 'James Ethan',
            'username' => 'james_ethan890',
            'phone_no' => '914-960-3665',
            'email' => 'james_ethan@gmail.com',
            'location' => 'Budapest, Hungary',
            'website' => 'www.jamesethan.com',
            'profile_picture' => '0000_avatar.jpeg',
        ]);
       
        $resume = Resume::make([
            'title' => 'Front-End Software Engineer'
        ]);

        $job = collect();

        // job 1
        $data = Job::make([
            'company_name' => 'Upstatement',
            'title' => 'Front-End Software Engineer',
            'location' => 'Boston, MA',
            'start_month' => 5,
            'start_year' => 2018,
            'end_month' => 8,
            'end_year' => 2021,
            'currently_work' => 'on'
        ]);

        $task = collect();

        $task = JobTask::where('job_id', $request->job_id)->make([
            'task_name' => 'Communicate and collaborate with multi-disciplinary teams of engineers, designers, producers, clients, and stakeholders on a daily basis',
            'task_name' => 'Write modern, performant, and robust code for a diverse array of client and internal projects'
        ])->push($task);

        $data->task = $task;

        $achievement = collect();

        $achievement = JobAchievement::where('job_id', $request->job_id)->make([
            'achievement_name' => 'Work with a variety of different languages, frameworks, and content management systems such as JavaScript, TypeScript, React, Vue, NativeScript, Node.js, Craft, Prismic, etc.',
            'achievement_name' => 'Helped solidify a brand direction for blistabloc to span across print, packaging, and web'
        ])->push($achievement);

        $data->achievement = $achievement;

        $job->push($data);

        $job = collect();
        // job 2
        $data = Job::make([
            'company_name' => 'Apple',
            'title' => 'UI Engineer Co-op',
            'location' => 'Cupertino, CA',
            'start_month' => 7,
            'start_year' => 2017,
            'end_month' => 12,
            'end_year' => 2017,
            'currently_work' => 0
        ]);

        $task = collect();

        $task = JobTask::where('job_id', $request->job_id)->make([
            'task_name' => 'Developed and shipped highly interactive web applications for Apple Music using Ember',
            'task_name' => 'Built and shipped the Apple Music Extension within Facebook Messenger leveraging third-party and internal APIs'
        ])->push($task);

        $data->task = $task;

        $achievement = collect();

        $achievement = JobAchievement::where('job_id', $request->job_id)->make([
            'achievement_name' => 'Architected and implemented the front-end of Apple Music embeddable web player widget, which lets users log in and listen to full songs in the browser',
            'achievement_name' => 'Contributed extensively to MusicKit.js, a JavaScript framework that allows developers to add an Apple Music player to their web apps'
        ])->push($achievement);

        $data->achievement = $achievement;

        $job->push($data);

        $education = collect();
        // education 1
        $data = Education::make([
            'school' => 'Northeastern University',
            'degree' => 'Bachelor of Science in Information Science',
            'result' => '3.78',
            'start_month' => 1,
            'start_year' => 2013,
            'end_month' => 8,
            'end_year' => 2018
        ]);

        $achievement = collect();

        $achievement = EducationAchievement::where('education_id', $request->education_id)->make([
            'achievement_name' => 'Human Computer Interaction Concentration Minors in Interaction & Experience Design',
            'achievement_name' => 'Dean lists in semester 2 until semester 5'
        ])->push($achievement);

        $data->achievement = $achievement;

        $education->push($data);

        $education = collect();
        // education 2
        $data = Education::make([
            'school' => 'Study Abroad',
            'degree' => 'Experience Design of Travel Dialogue',
            'result' => '3.38',
            'start_month' => 4,
            'start_year' => 2016,
            'end_month' => 8,
            'end_year' => 2016
        ]);

        $achievement = collect();

        $achievement = EducationAchievement::where('education_id', $request->education_id)->make([
            'achievement_name' => 'Proposed and implemented scalable solutions to issues identified with cloud services and applications',
            'achievement_name' => 'Express for visualizing personalized Spotify data such as top artists, tracks, recommendations, and audio features'
        ])->push($achievement);

        $data->achievement = $achievement;

        $education->push($data);

        return view('template.'.$template)->with([
            'resume' => $resume,
            'educations' => $education,
            'jobs' => $job,
            'user' => $user,
        ]);
    }
}
