<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class MyJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAnyEmployer', Job::class);
        return view('MyJobs.index', [
            'jobs' => $request->user()->employer
                    ->jobs()
                    ->with(['employer', 'job_applications', 'job_applications.user'])
                    ->withTrashed()
                    ->get()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Job::class);
        return view('MyJobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        
        $request->user()->employer->jobs()->create($request->validated());

        return redirect()->route('my-jobs.index')->with('success', 'New job has been created');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $my_job)
    {
        $this->authorize('update', $my_job);
        return view('MyJobs.edit', ['job' => $my_job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $my_job)
    {
        $this->authorize('update', $my_job);
        $my_job->update($request->validated());

        return redirect()->route('my-jobs.index')->with('success', 'Job updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $my_job)
    {
        $my_job->delete();

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job deleted.');
    }
}
