<x-layout>
    <x-page-heading>My Jobs</x-page-heading>
    
    <section>
        <div class="mt-6 space-y-6">
    
            @forelse ($jobs as $job )
                <x-my-job-card-wide :$job></x-my-job-card-wide>
                @empty
                    <h1 class="text-center">You Have No Jobs</h1>
            @endforelse
        </div>
    </section>
</x-layout>