
<x-layout>

    <x-bread-crumbs 
        class="mb-4" 
        :links="[ 
            'Jobs' => route('jobs.index'),
            $job->title => '#'
        ]"
    />

    <x-job-card class="mb-4" :$job>

        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description)) !!}
        </p>

        @can('apply', $job)
            
            <x-link-button :href="route('job.application.create', $job)">
                Apply
            </x-link-button>

        @else 

            <div class="text-center text-sm font-medium text-slate-500">
                You already applied to this job
            </div>
            
        @endcan



    </x-job-card>

    <x-card class="mb-4">

        <h4 class="mb-4 text-lg font-medium">
            More {{ $job->employer->company_name }} Jobs
        </h4>

        <div class="text-sm text-slate-500">

            @foreach ($job->employer->jobs as $employer_job)
                
                <div class="mb-4 flex justify-between">

                    <div>

                        <div class="text-slate-700">

                            @if ($employer_job->id === $job->id)
                                {{ $employer_job->title }}
                            @else
                                <a href="{{ route('jobs.show', $employer_job) }}" class="hover:text-black">{{ $employer_job->title }}</a>
                            @endif


                        </div>

                        <div class="text-xs">
                            {{ $employer_job->created_at->diffForHumans() }}
                        </div>

                    </div>
                    
                    <div class="text-xs">

                        ${{ number_format($employer_job->salary) }}

                    </div>

                </div>

            @endforeach

        </div>

    </x-card>

</x-layout>
