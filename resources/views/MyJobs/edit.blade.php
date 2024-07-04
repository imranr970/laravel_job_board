<x-layout>

    <x-breadcrumbs 
        :links="[
            'My Jobs' => route('my-jobs.index'),
            'Edit' => '#'
        ]"
    />

    <x-card class="mb-8">

        <form action="{{ route('my-jobs.update', $job) }}" method="POST">

            @csrf

            @method("PUT")

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <x-label for="title" :required="true">Title</x-label>
                    <x-text-input name="title" :value="old('title') ?? $job->title" />
                </div>

                <div>
                    <x-label for="location" :required="true">Location</x-label>
                    <x-text-input name="location" :value="old('location') ?? $job->location" />
                </div>

                <div class="col-span-2">
                    <x-label for="salary" :required="true">Salary</x-label>
                    <x-text-input name="salary" type="number" :value="old('salary') ?? $job->salary" />
                </div>

                <div class="col-span-2">
                    <x-label for="description" :required="true">Description</x-label>
                    <x-text-input name="description" type="textarea" :value="old('description') ?? $job->description" />
                </div>

                <div>
                    <x-label for="experience" :required="true">Experience</x-label>
                    <x-radio-group 
                        name="experience"
                        :value="$job->experience"
                        :default="false"
                        :options="\App\Models\Job::$experience" 
                    /> 
                </div>

                <div>
                    <x-label for="category" :required="true">Category</x-label>
                    <x-radio-group 
                        name="category" 
                        :default="false" 
                        :value="$job->category"
                        :options="\App\Models\Job::$category" 
                    />
                </div>

                <div class="col-span-2">
                    <x-button class="w-full" type="submit">Edit Job</x-button>
                </div>

            </div>

        </form>

    </x-card>

</x-layout>