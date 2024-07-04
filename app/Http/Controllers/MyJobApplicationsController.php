<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;

class MyJobApplicationsController extends Controller
{

    public function index(Request $request)
    {
        $applications = $request->user()->job_applications()
            ->with([
                'job' => fn($query) => $query->withCount('job_applications')
                        ->withAvg('job_applications', 'expected_salary')
                        ->withTrashed(),
                'job.employer'
            ])
            ->latest()
            ->get();

        return view('MyJobApplications.index', compact('applications'));    
    }

    public function destroy(JobApplication $myJobApplication)
    {
        Storage::disk("private")->delete($myJobApplication->cv_path);
        $myJobApplication->delete();

        return back()->with(
            'success',
            'Job application removed.'
        );
    }
}
