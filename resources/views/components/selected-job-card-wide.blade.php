@props(['job'])

<x-panel class="gap-x-6 space-y-4">
    <div class="flex text-center gap-x-3">
        <x-employer-logo :employer="$job->employer"/>
        <a href="" class="self-start text-m text-gray-500 text-center items-center my-auto">{{$job->employer->name}}</a>
    </div>
    <div class="flex-1 flex flex-col">
        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-600  transition-colors duration-400 ">
            <a href="{{ $job->url }}">
            {{$job->title}}
            </a>
        </h3>
        <p class="text-sm text-gray-500 mt-auto">{{$job->schedule}} - From {{ $job->salary }}</p>
    </div>
    <div>
        <p>Placegolder is a creative-first digital studio focused on building bold, interactive, and meaningful online experiences. We partner with brands, artists, and startups to develop websites and digital products that stand out. Whether it’s a slick portfolio, a custom landing page, or a full-featured web app—we design and build with purpose. We’re looking for a passionate Web Developer who thrives on turning ideas into clean, efficient, and responsive websites. You'll collaborate closely with designers, content creators, and project managers to build custom websites and help evolve our development stack. This role is perfect for someone who loves problem-solving, clean code, and staying ahead of web trends.</p>
    </div>
    <div class="flex flex-col">
        <div class="flex flex-wrap gap-2"> <!-- Tags will be in a horizontal row with wrapping if needed -->
            @foreach ($job->tags as $tag )
                <x-tag :$tag/> <!-- Render each tag -->
            @endforeach
        </div>
        @role('job_seeker') 
            <a class="mt-auto self-end" href="/jobs/{{ $job->id }}/apply">
                <x-forms.button>Apply</x-forms.button> <!-- Only job seekers will see the apply button -->
            </a>
        @endrole
    </div>
</x-panel>