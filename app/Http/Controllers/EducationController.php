<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\EducationAchievement;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EducationController extends Controller
{
    public function store(Request $request)
    {
        if($request->resume_id !== auth()->user()->id){
            abort(403);
        }

        $request->validate([
            'resume_id' => 'required',
            'school' => 'required',
            'degree' => 'required',
            'result' => 'required',
            'start_month' => 'required',
            'start_year' => 'required',
            'end_month' => 'required',
            'end_year' => 'required',
            'education_achievement.*' => 'nullable'
        ]);

        $education = Education::create([
            'resume_id' => $request->resume_id,
            'school' => $request->school,
            'degree' => $request->degree,
            'result' => $request->result,
            'start_month' => $request->start_month,
            'start_year' => $request->start_year,
            'end_month' => $request->end_month,
            'end_year' => $request->end_year
        ]);

        foreach ($request->get('education_achievement') as $achievement) {
            $education->achievements()->create([
                'achievement_name' => $achievement
            ]);
        }

        return redirect()->route('resume.view-edit-resume', $education->resume_id)
            ->with('success', 'Education has been added.');
    }

    public function update(Request $request)
    {
        if($request->resume_id !== auth()->user()->id){
            abort(403);
        }

        $resume = Resume::findOrFail($request->resume_id);

        $education = $resume->educations()->where('id', $request->education_id)->first();

        // TODO: Validation

        $education->update([
            'school' => $request->school,
            'degree' => $request->degree,
            'result' => $request->result,
            'start_month' => $request->start_month,
            'start_year' => $request->start_year,
            'end_month' => $request->end_month,
            'end_year' => $request->end_year
        ]);

        foreach ($request->get('education_achievement') as $achievement) {
            $education->achievements()->create([
                'achievement_name' => $achievement
            ]);
        }

        $education->achievements()->delete();

        return redirect()->route('resume.view-edit-resume', $education->resume_id)
            ->with('success', 'Education ' . $request->school . ' has been updated.');
    }

    public function destroy(Request $request)
    {
        $education = Education::findOrFail($request->id);

        if($education->resume->user_id !== auth()->user()->id){
            abort(403);
        }

        $education->achievements()->delete();

        $education->delete();

        return redirect()->route('resume.view-edit-resume', $education->resume_id)
            ->with('success', $request->school.' has been deleted.');
    }
}
