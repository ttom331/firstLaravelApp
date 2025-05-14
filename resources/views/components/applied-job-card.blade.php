@props(['job'])

<x-panel class="flex gap-x-6">
    <div>
        <x-employer-logo :employer="$job->employer"/>
    </div>
    <div class="flex-1 flex flex-col">
        <a href="" class="self-start text-sm text-gray-500">{{ $job->employer->name }}</a>
        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-600  transition-colors duration-400 ">
            <a href="/jobs/{{$job->id}}">
            {{$job->title}}
            </a>
        </h3>
        <p class="text-sm text-gray-500 mt-auto">{{$job->schedule}} - From {{ $job->salary }}</p>
    </div>

    <div class="flex flex-col my-auto">
        <p>Applied on: {{  $job->pivot->applied_at }}</p>
        <p>Status: {{ ucfirst($job->pivot->status) }}</p>
    </div>
</x-panel>