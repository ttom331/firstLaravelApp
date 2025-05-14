@props(['job'])

<x-panel class="flex gap-x-6">
    <div>
        <x-employer-logo :employer="$job->employer"/>
    </div>
    <div class="flex-1 flex flex-col">
        <a href="" class="self-start text-sm text-gray-500">{{$job->employer->name}}</a>
        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-600  transition-colors duration-400 ">
            <a href="{{ $job->url }}">
            {{$job->title}}
            </a>
        </h3>
        <p class="text-sm text-gray-500 mt-auto">{{$job->schedule}} - From {{ $job->salary }}</p>
    </div>

    <div class="flex flex-col">
        <div class="flex flex-wrap gap-2 self-end"> <!-- Tags will be in a horizontal row with wrapping if needed -->
            @foreach ($job->tags as $tag )
                <x-tag :$tag/> <!-- Render each tag -->
            @endforeach
        </div>
        <div class="flex mt-auto self-end space-x-3">
            <a href="jobs/{{$job->id}}/edit"><x-forms.button>Edit Job</x-forms.button></a>
            <a href="myjobs/{{$job->id}}/applicants"><x-forms.button>View Applicants</x-forms.button></a>
        </div>
    </div>
</x-panel>
