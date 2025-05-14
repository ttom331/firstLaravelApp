@props(['applicant', 'job'])
@php $roles = ['Under Consideration', 'Interviewing', 'Interviewed', 'Offer', 'Offer Rejected', 'Rejected']; @endphp
<x-panel class="mt-4">
    <div class="flex gap-x-6">
        <div class="flex-1 flex flex-col">
            <div class="flex space-x-1">
                <h4 class="font-bold">{{$applicant->name}} |</h4>
                <p>{{ $applicant->email }}</p>
            </div>
            <div class="flex space-x-1">
                <p>Applied on:</p>
                <p class="text-blue-500">{{  $applicant->pivot->applied_at }}</p>
            </div>
            <div class="flex space-x-1">
                <div>
                <x-forms.form method="patch" action="/myjobs/{{$job->id}}/applicants">
                    <div class="flex space-x-1">
                        <x-forms.select padding="py-1" radius="rounded-sm" type="select" name="status" label="">
                        <option class="bg-black" value="{{ $applicant->pivot->status }}">{{ ucfirst($applicant->pivot->status) }}</option>
                        @foreach ($roles as $role )
                            <option class="bg-black" value="{{ $role }}">{{ ucfirst($role) }}</option>
                        @endforeach
                        </x-forms.select>
                        <x-forms.input type="hidden" name="job" label="" value="{{ $applicant->pivot->job_id}}"></x-forms.input>
                        <x-forms.input type="hidden" name="applicant" label="" value="{{ $applicant->pivot->user_id}}"></x-forms.input>
                        <x-forms.button padding="mt-1 px-2 text-sm" radius='rounded-sm'>Update Status</x-forms.button>
                    </div>
                </x-forms.form>
                </div>
            </div>
        </div>
        <div class="flex flex-col mt-auto">
            <x-forms.form class="mx-auto" method="post" action="/cv">
                <x-forms.input type="hidden" name="cv" label="" value="{{$applicant->cv_path}}"></x-forms.input>
                <x-forms.input type="hidden" name="name" label="" value="{{$applicant->name}}"></x-forms.input>
                <x-forms.button>Download CV</x-forms.button>
            </x-forms.form>
        </div>
    </div>
   
</x-panel>