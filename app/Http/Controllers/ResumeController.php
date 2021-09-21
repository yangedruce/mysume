<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResumeController extends Controller
{
    public function create()
    {
        return view('resume.create-new-resume', [
            'templates' => Template::all()
        ]);
    }

    public function store(Request $request)
    {
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

    public function show(User $user, Resume $resume)
    {
        if ($resume->status !== 'Published') {
            abort(404);
        }

        return view("template.{$resume->template->name}", [
            'resume' => $resume,
            'educations' => $resume->educations,
            'jobs' => $resume->jobs,
            'user' => $user,
        ]);
    }

    public function edit(Resume $resume)
    {
        if ($resume->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('resume.edit-resume', [
            'resume' => $resume,
            'educations' => $resume->educations,
            'jobs' => $resume->jobs,
        ]);
    }

    public function update(Resume $resume, Request $request)
    {
        $resume->update(['status' => $request->status]);

        $message = $resume->status === 'Draft' ? "Resume {$resume->title} has been set as draft."
            : "Resume {$resume->title} has been published.";

        return redirect()->back()->with('success', $message);
    }

    public function destroy(Resume $resume)
    {
        $title = $resume->title;

        foreach ($resume->jobs as $job) {
            $job->tasks()->delete();

            $job->achievements()->delete();

            $job->delete();
        }

        foreach ($resume->educations as $education) {
            $education->achievements()->delete();

            $education->delete();
        }

        $resume->delete();

        return redirect()->route('home')->with('success', 'Resume ' . $title . ' has been deleted.');
    }
}
