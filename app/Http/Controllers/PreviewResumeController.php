<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\EducationAchievement;
use App\Models\Job;
use App\Models\JobTask;
use App\Models\JobAchievement;
use App\Models\Resume;
use App\Models\User;

class PreviewResumeController extends Controller
{
    // Preview resume with dummy data
    public function show($template)
    {
        // user
        $user                   = new User;
        $user->fullname         = 'James Ethan';
        $user->username         = 'james_ethan890';
        $user->phone_no         = '914-960-3665';
        $user->email            = 'james_ethan@gmail.com';
        $user->location         = 'Budapest, Hungary';
        $user->website          = 'www.jamesethan.com';
        $user->profile_picture  = '0000_avatar.jpeg';

        // resume
        $resume         = new Resume;
        $resume->title  = 'Front-End Software Engineer';

        // job 1
        $job = collect();

        $data                   = new Job;
        $data->company_name     = 'Upstatement';
        $data->title            = 'Front-End Software Engineer';
        $data->location         = 'Boston, MA';
        $data->start_month      = 5;
        $data->start_year       = 2018;
        $data->end_month        = 8;
        $data->end_year         = 2021;
        $data->currently_work   = 'on';

        $childCollection = collect();

        $child              = new JobTask;
        $child->task_name   = 'Communicate and collaborate with multi-disciplinary teams of engineers, designers,
        producers, clients, and stakeholders on a daily basis';
        $childCollection->push($child);

        $child              = new JobTask;
        $child->task_name   = 'Write modern, performant, and robust code for a diverse array of client and internal projects';
        $childCollection->push($child);

        $data->task = $childCollection;

        $childCollection = collect();

        $child                      = new JobAchievement;
        $child->achievement_name    = 'Work with a variety of different languages, frameworks, and content management systems
        such as JavaScript, TypeScript, React, Vue, NativeScript, Node.js, Craft, Prismic, etc.';
        $childCollection->push($child);

        $child                      = new JobAchievement;
        $child->achievement_name    = 'Helped solidify a brand direction for blistabloc to span across print, packaging, and web';
        $childCollection->push($child);

        $data->achievement = $childCollection;

        $job->push($data);

        // job 2
        $data                   = new Job;
        $data->company_name     = 'Apple';
        $data->title            = 'UI Engineer Co-op';
        $data->location         = 'Cupertino, CA';
        $data->start_month      = 7;
        $data->start_year       = 2017;
        $data->end_month        = 12;
        $data->end_year         = 2017;
        $data->currently_work   = 0;

        $childCollection = collect();

        $child              = new JobTask;
        $child->task_name   = 'Developed and shipped highly interactive web applications for Apple Music using Ember';
        $childCollection->push($child);

        $child              = new JobTask;
        $child->task_name   = 'Built and shipped the Apple Music Extension within Facebook Messenger leveraging third-
        party and internal APIs';
        $childCollection->push($child);

        $data->task = $childCollection;

        $childCollection = collect();

        $child                      = new JobAchievement;
        $child->achievement_name    = 'Architected and implemented the front-end of Apple Music embeddable web player widget,
        which lets users log in and listen to full songs in the browser';
        $childCollection->push($child);

        $child                      = new JobAchievement;
        $child->achievement_name    = 'Contributed extensively to MusicKit.js, a JavaScript framework that allows developers to add
        an Apple Music player to their web apps';
        $childCollection->push($child);

        $data->achievement = $childCollection;

        $job->push($data);

        // education 1
        $education = collect();

        $data               = new Education;
        $data->school       = 'Northeastern University';
        $data->degree       = 'Bachelor of Science in Information Science';
        $data->result       = '3.78';
        $data->start_month  = 1;
        $data->start_year   = 2013;
        $data->end_month    = 8;
        $data->end_year     = 2018;

        $childCollection = collect();

        $child                      = new EducationAchievement;
        $child->achievement_name    = 'Human Computer Interaction Concentration Minors in Interaction & Experience Design';
        $childCollection->push($child);

        $data->achievement = $childCollection;

        $child                      = new EducationAchievement;
        $child->achievement_name    = 'Dean lists in semester 2 until semester 5';
        $childCollection->push($child);

        $data->achievement = $childCollection;

        $education->push($data);

        // education 2
        $data               = new Education;
        $data->school       = 'Study Abroad';
        $data->degree       = 'Experience Design of Travel Dialogue';
        $data->result       = '3.38';
        $data->start_month  = 4;
        $data->start_year   = 2016;
        $data->end_month    = 8;
        $data->end_year     = 2016;

        $childCollection = collect();

        $child                      = new EducationAchievement;
        $child->achievement_name    = 'Proposed and implemented scalable solutions to issues identified with cloud services and applications';
        $childCollection->push($child);

        $data->achievement = $childCollection;

        $child                      = new EducationAchievement;
        $child->achievement_name    = 'Express for visualizing personalized Spotify data such as top artists, tracks, recommendations, and audio features';
        $childCollection->push($child);

        $data->achievement = $childCollection;

        $education->push($data);

        return view('template.'.$template)->with([
            'resume'        => $resume,
            'educations'    => $education,
            'jobs'          => $job,
            'user'          => $user,
        ]);
    }
}
