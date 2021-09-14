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

class ResumeController extends Controller
{
    public function create() {
        return view('resume.create-new-resume', [
            'templates' => Template::all()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'template' => ['required', Rule::exists('templates', 'id')]
        ]);

        $resume = auth()->user()->resumes()->create([
            'title' => $request->title,
            'template_id' => $request->template,
            'status' => 'Draft'
        ]);

        return redirect()->route('resume.view-edit-resume', $resume->id)
            ->with('success', "Resume {$resume->title} has been created.");
    }

    public function show(User $user, Resume $resume) {
        if($resume->status !== 'Published'){
            abort(404);
        }

        return view("template.{$resume->template->name}", [
            'resume' => $resume,
            'educations' => $resume->educations,
            'jobs' => $resume->jobs,
            'user' => $user,
        ]);
    }

    public function edit(Resume $resume) {
        if($resume->user_id !== auth()->user()->id)
        {
            abort(403);
        }

        return view('resume.edit-resume', [
            'resume'        => $resume,
            'educations'    => $resume->educations,
            'jobs'          => $resume->jobs,
        ]);
    }

    public function update(Resume $resume, Request $request) {
        $resume->update(['status' => $request->status]);

        $message = $resume->status === 'Draft' ? "Resume {$resume->title} has been set as draft."
            : "Resume {$resume->title} has been published.";

        return redirect()->back()->with('success', $message);
    }

    public function destroy(Resume $resume, Request $request) {
        $title = $resume->title;

        foreach ($resume->jobs as $job) {
            $job->task()->delete();

            $job->achievement()->delete();

            $job->delete();
        }

        foreach ($resume->educations as $education) {
            $education->achievement()->delete();

            $education->delete();
        }

        $resume->delete();

        return redirect()->route('home')->with('success', 'Resume '.$title.' has been deleted.');
    }








    // Preview resume with dummy data
    public function previewResume($template) {
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

    // View edit resume settings
    public function viewEditResumeSettings(Request $request, $resume_id) {
        $user_id    = auth()->user()->id;
        $template   = Template::all();
        $resume     = Resume::where('id', $resume_id)->where('user_id', $user_id)->first();

        // view resume template
        if($resume!=null) {
            return view('resume.create-new-resume')->with([
                'resume'    => $resume,
                'templates' => $template
            ]);
        }

        return redirect()->route('home')->with([
            'error' => 'Resume is not available'
        ]);
    }

    // Update resume settings
    public function updateResumeSettings(Request $request) {
        $resume_id  = $request->resume_id;
        $title      = $request->title;
        $template   = $request->template;

        $resume                 = Resume::where('id', $resume_id)->first();
        $resume->title          = $title;
        $resume->template_id    = $template;

        $resume->save();

        $request->session()->flash('success', 'Resume '.$title.' has been updated.');
        return redirect()->route('resume.view-edit-resume', $resume_id);
    }

    // Add job
    public function addJob(Request $request) {
        $resume_id          = $request->resume_id;
        $company_name       = $request->company_name;
        $title              = $request->title;
        $location           = $request->location;
        $start_month        = $request->start_month;
        $start_year         = $request->start_year;
        $current            = $request->current;
        $end_month          = $request->end_month;
        $end_year           = $request->end_year;
        $task_no            = $request->task_no;
        $job_achievement_no = $request->job_achievement_no;

        if($current==null) {
            $current = false;
        }

        $job                    = new Job;
        $job->resume_id         = $resume_id;
        $job->company_name      = $company_name;
        $job->title             = $title;
        $job->location          = $location;
        $job->start_month       = $start_month;
        $job->start_year        = $start_year;
        $job->currently_work    = $current;

        if(!$current) {
            $job->end_month   = $end_month;
            $job->end_year    = $end_year;
        }

        $job->save();

        // add job tasks
        for($i = 1; $i < $task_no+1; $i++) {
            $attribute = 'job_task_'.$i;

            if($request->$attribute!="") {
                $jobTask            = new JobTask;
                $jobTask->job_id    = $job->id;
                $jobTask->task_name = $request->$attribute;

                $jobTask->save();
            }
        }

        // add job achievements
        for($i = 1; $i < $job_achievement_no+1; $i++) {
            $attribute = 'job_achievement_'.$i;

            if($request->$attribute!="") {
                $jobAchievement                     = new JobAchievement;
                $jobAchievement->job_id             = $job->id;
                $jobAchievement->achievement_name   = $request->$attribute;

                $jobAchievement->save();
            }
        }

        $request->session()->flash('success', 'Job has been added.');
        return redirect()->route('resume.view-edit-resume', $resume_id);
    }

    // Add education
    public function addEducation(Request $request) {
        $resume_id                  = $request->resume_id;
        $school                     = $request->school;
        $degree                     = $request->degree;
        $result                     = $request->result;
        $start_month                = $request->start_month;
        $start_year                 = $request->start_year;
        $end_month                  = $request->end_month;
        $end_year                   = $request->end_year;
        $education_achievement_no   = $request->education_achievement_no;

        $education              = new Education;
        $education->resume_id   = $resume_id;
        $education->school      = $school;
        $education->degree      = $degree;
        $education->result      = $result;
        $education->start_month = $start_month;
        $education->start_year  = $start_year;
        $education->end_month   = $end_month;
        $education->end_year    = $end_year;

        $education->save();

        // add education achievements
        for($i = 1; $i < $education_achievement_no+1; $i++) {
            $attribute = 'education_achievement_'.$i;

            if($request->$attribute!="") {
                $educationAchievement                     = new EducationAchievement;
                $educationAchievement->education_id       = $education->id;
                $educationAchievement->achievement_name   = $request->$attribute;

                $educationAchievement->save();
            }
        }

        $request->session()->flash('success', 'Education has been added.');
        return redirect()->route('resume.view-edit-resume', $resume_id);
    }

    // Edit job
    public function editJob(Request $request) {
        $resume_id          = $request->resume_id;
        $job_id             = $request->job_id;
        $company_name       = $request->company_name;
        $title              = $request->title;
        $location           = $request->location;
        $start_month        = $request->start_month;
        $start_year         = $request->start_year;
        $current            = $request->current;
        $end_month          = $request->end_month;
        $end_year           = $request->end_year;
        $task_no            = $request->task_no;
        $job_achievement_no = $request->job_achievement_no;

        // currently work on/0
        if($current==null) {
            $current = false;
        }

        $job                    = Job::where('id', $job_id)->first();
        $job->resume_id         = $resume_id;
        $job->company_name      = $company_name;
        $job->title             = $title;
        $job->location          = $location;
        $job->start_month       = $start_month;
        $job->start_year        = $start_year;
        $job->currently_work    = $current;

        // currently work 0
        if(!$current) {
            $job->end_month   = $end_month;
            $job->end_year    = $end_year;
        }

        $job->save();

        // edit job tasks & achievements
        $task           = array();
        $achievement    = array();

        // edit job tasks
        for($i = 1; $i < $task_no+1; $i++) {
            $attribute = 'job_task_id_'.$i;

            $task_value = $request->$attribute;

            if($task_value!=null) {
                $jobTask = JobTask::where('id', $task_value)->first();
            }else {
                $jobTask            = new JobTask;
                $jobTask->job_id    = $job_id;
            }

            $attribute = 'job_task_'.$i;
            $jobTask->task_name = $request->$attribute;

            if($request->$attribute!="") {
                $jobTask->save();
                array_push($task, $jobTask->id);
            }
        }

        $allTask = JobTask::where('job_id', $job_id)->get();

        if(count($allTask) > 0) {
            foreach($allTask as $i => $checkTask) {
                if(!in_array($checkTask->id, $task)) {
                    $checkTask->delete();
                }
            }
        }

        // edit job achievements
        for($i = 1; $i < $job_achievement_no+1; $i++) {
            $attribute = 'job_achievement_id_'.$i;

            $achievement_value = $request->$attribute;

            if($achievement_value!=null) {
                $jobAchievement = JobAchievement::where('id', $achievement_value)->first();
            }else {
                $jobAchievement            = new JobAchievement;
                $jobAchievement->job_id    = $job_id;
            }

            $attribute = 'job_achievement_'.$i;

            $jobAchievement->achievement_name = $request->$attribute;

            if($request->$attribute!="") {
                $jobAchievement->save();
                array_push($achievement, $jobAchievement->id);
            }
        }

        $allAchievement = JobAchievement::where('job_id', $job_id)->get();

        if(count($allAchievement) > 0) {
            foreach($allAchievement as $i => $checkAchievement) {
                if(!in_array($checkAchievement->id, $achievement)) {
                    $checkAchievement->delete();
                }
            }
        }

        $request->session()->flash('success', 'Job '.$company_name.' has been updated.');
        return redirect()->route('resume.view-edit-resume', $resume_id);
    }

    // Edit education
    public function editEducation(Request $request) {
        $resume_id                  = $request->resume_id;
        $education_id               = $request->education_id;
        $school                     = $request->school;
        $degree                     = $request->degree;
        $result                     = $request->result;
        $start_month                = $request->start_month;
        $start_year                 = $request->start_year;
        $end_month                  = $request->end_month;
        $end_year                   = $request->end_year;
        $education_achievement_no   = $request->education_achievement_no;

        $education              = Education::where('id', $education_id)->first();
        $education->resume_id   = $resume_id;
        $education->school      = $school;
        $education->degree      = $degree;
        $education->result      = $result;
        $education->start_month = $start_month;
        $education->start_year  = $start_year;
        $education->end_month   = $end_month;
        $education->end_year    = $end_year;

        $education->save();

        // education achievements
        $achievement    = array();

        for($i = 1; $i < $education_achievement_no+1; $i++) {
            $attribute = 'education_achievement_id_'.$i;

            $achievement_value = $request->$attribute;

            if($achievement_value!=null) {
                $educationAchievement =EducationAchievement::where('id', $achievement_value)->first();
            }else {
                $educationAchievement               = new EducationAchievement;
                $educationAchievement->education_id = $education_id;
            }

            $attribute = 'education_achievement_'.$i;

            $educationAchievement->achievement_name = $request->$attribute;

            if($request->$attribute!="") {
                $educationAchievement->save();
                array_push($achievement, $educationAchievement->id);
            }
        }

        $allAchievement = EducationAchievement::where('education_id', $education_id)->get();

        if(count($allAchievement) > 0) {
            foreach($allAchievement as $i => $checkAchievement) {
                if(!in_array($checkAchievement->id, $achievement)) {
                    $checkAchievement->delete();
                }
            }
        }

        $request->session()->flash('success', 'Education '.$school.' has been updated.');
        return redirect()->route('resume.view-edit-resume', $resume_id);
    }

    // Delete job/education
    public function deleteJobEducation(Request $request) {
        $resume_id      = $request->resume_id;
        $id             = $request->id;
        $type           = $request->type;

        if($type=='job') {
            $delete     = Job::where('id', $id)->where('resume_id', $resume_id)->first();
            $message    = 'Job '.$delete->company_name;

            $tasks = JobTask::where('job_id', $id)->get();
            $tasks->each->delete();

            $achievements = JobAchievement::where('job_id', $id)->get();
            $achievements->each->delete();
        }else {
            $delete     = Education::where('id', $id)->where('resume_id', $resume_id)->first();
            $message    = 'Education '.$delete->school;

            $achievements = EducationAchievement::where('education_id', $id)->get();
            $achievements->each->delete();
        }

        $delete->delete();

        $request->session()->flash('success', $message.' has been deleted.');
        return redirect()->route('resume.view-edit-resume', $resume_id);
    }
}
