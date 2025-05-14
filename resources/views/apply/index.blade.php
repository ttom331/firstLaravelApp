<x-layout>
    <x-page-heading>{{ $job->title }}</x-page-heading>
    <x-forms.form method="post" action="/jobs/{{ $job->id }}/apply" enctype="multipart/form-data">
    <p class="text-lg text-gray-500 mb-6 text-center">Please confirm you want to apply to this job!</p>    
        <x-forms.input type="hidden" name="job_id" label="" value="{{ $job->id }}"></x-forms.input>
        <x-forms.button class="flex mx-auto items-center justify-center">Confirm</x-forms.button>
    </x-forms.form>
</x-layout>