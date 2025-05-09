@props(['job'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm">{{ $job->employer->name }}</div>
        <div class="py-8">
            <h3 class="group-hover:text-blue-600 transition-colors duration-400 text-xl font-bold">
                <a href="/jobs/{{$job->id}}">
                {{$job->title}}
                </a>
            </h3>
            <p class="mt-4 text-sm">{{$job->schedule}} - From {{ $job->salary }}</p>
        </div>
    <div>
        <div class="flex justify-between items-center mt-auto">
            <div>
                @foreach ($job->tags as $tag )
                    <x-tag size="small" :$tag/> <!-- Use small style for tag -->
                @endforeach
            </div>

            <x-employer-logo :employer="$job->employer" :width="42"/>
        </div>   
    </div>
</x-panel>