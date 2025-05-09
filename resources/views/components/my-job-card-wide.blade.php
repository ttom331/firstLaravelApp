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
        <div class="flex flex-wrap gap-2"> <!-- Tags will be in a horizontal row with wrapping if needed -->
            @foreach ($job->tags as $tag )
                <x-tag :$tag/> <!-- Render each tag -->
            @endforeach
        </div>
        <a href="jobs/{{$job->id}}/edit" class="mt-auto self-end"><x-forms.button>Edit Job</x-forms.button></a>
    </div>
</x-panel>
