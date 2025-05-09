<x-layout>
    <x-page-heading>Edit Job - {{ $job->title }}</x-page-heading>
    <x-forms.form method="patch" action="/jobs/{{ $job->id }}">
        <x-forms.input label="Title" name="title" value="{{ $job->title }}" placeholder="CEO"/>
        <x-forms.input label="Salary" name="salary" value="{{ $job->salary }}" placeholder="£90,000 GBP"/>
        <x-forms.input label="Location" name="location" value="{{ $job->location }}" placeholder="Yeovil Junction"/>

        <x-forms.select label="Schedule" name="schedule">
            <option>Part Time</option>
            <option>Full Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" value="{{ $job->url }}" placeholder="https://example.com/jobs/webdevneeded"/>
        <x-forms.checkbox label="Feature (Job)" name="featured"/>

        <x-forms.input label="Tags (comma seperated)" name="tags" value="{{ $job->tags->pluck('name')->implode(', ') }}" placeholder="frontend, ux design, developer"/>

        <x-forms.button type="submit">Edit</x-forms.button>
        
    </x-forms.form>
</x-layout>