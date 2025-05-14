<x-layout>
    @if (session('success'))
        <x-alert>{{ session('success') }}</x-alert>
    @endif
    <x-page-heading>Applicants</x-page-heading>
    @foreach ($job->applicants as $applicant)
        <x-applicants :applicant="$applicant" :job="$job"></x-applicants>
    @endforeach
</x-layout>
