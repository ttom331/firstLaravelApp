<x-layout>
    <div class="space-y-6">
        @foreach ($user->appliedjobs as $job)
            <x-applied-job-card :$job></x-applied-job-card>
        @endforeach
    </div>
</x-layout>