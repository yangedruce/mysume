<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\EducationAchievement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EducationController extends Controller
{
    public function store(Request $request)
    {
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
        $education = Education::where('id', $request->education_id)->first();

        $education->update([
            'school' => $request->school,
            'degree' => $request->degree,
            'result' => $request->result,
            'start_month' => $request->start_month,
            'start_year' => $request->start_year,
            'end_month' => $request->end_month,
            'end_year' => $request->end_year
        ]);

        $education->achievements()->delete();

        foreach ($request->get('education_achievement') as $achievement) {
            $education->achievements()->create([
                'achievement_name' => $achievement
            ]);
        }

        return redirect()->route('resume.view-edit-resume', $education->resume_id)
            ->with('success', 'Education ' . $request->school . ' has been updated.');
    }
}
