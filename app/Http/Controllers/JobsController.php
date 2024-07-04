<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
        

    public function index(Request $request) 
    {
        $this->authorize('viewAny', Job::class);
        $filters = $request->only([
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        ]);

        return view('jobs.index', ['jobs' => Job::with('employer')->latest()->filter($filters)->get()]);

    }

    public function show(Job $job) 
    {
        $this->authorize('view', $job);
        return view('jobs.show', [
            'job' => $job->load('employer.jobs')
        ]);
    }

}
