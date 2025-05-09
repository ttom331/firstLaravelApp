<x-layout>
    <x-page-heading>Results</x-page-heading>
    <div class="space-y-6">
        @forelse ($jobs as $job)
            <x-job-card-wide :$job />
        @empty
            <p class="text-2xl text-center">No Jobs were found.</p>
        @endforelse
    </div>
</x-layout>
