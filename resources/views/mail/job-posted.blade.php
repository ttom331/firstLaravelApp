<h2>
    {{ $job->title }}
</h2>
<p>
    Congrats your Job is now live and posted!
</p>
<p>
    <a href="{{ url("/jobs/{$job->id}") }}">View Your Job Listing</a>
</p>