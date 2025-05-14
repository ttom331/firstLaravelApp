<x-layout>
    <x-page-heading>Register</x-page-heading>

    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
        <!-- Role Selection -->
            <x-forms.select label="Register as" name="role_id" type="select">
                @foreach ($roles as $role )
                    <option value={{$role->id}}>{{ ucfirst($role->name) }}</option>
                @endforeach
            </x-forms.select>
        <!-- Name and Email -->
        <x-forms.input label="Name" name="name"/>
        <x-forms.input label="Email" name="email" type="email"/>
        <x-forms.input label="Password" name="password" type="password"/>
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password"/>

        <!-- Employer-Specific Fields (Only show if 'employer' role is selected) -->
        <div id="employer-fields" class="hidden">
            <x-forms.divider/>
            <x-forms.input label="Employer Name" name="employer"/>
            <x-forms.input label="Employer Logo" name="logo" type="file"/>
        </div>

        <div id="jobseeker-fields" class="hidden">
            <x-forms.divider/>
            <x-forms.input label="Upload your CV" name="cv_path" type="file"/>
        </div>

        <x-forms.button>Create Account</x-forms.button>

    </x-forms.form>

    <script>
        // JavaScript to toggle employer fields based on role selection
        const roleSelect = document.querySelector('[name="role_id"]');
        const employerFields = document.getElementById('employer-fields');
        const jobSeekerFields = document.getElementById('jobseeker-fields');

        roleSelect.addEventListener('change', function() {
            if (this.value === '1') {
                employerFields.classList.remove('hidden');
                jobSeekerFields.classList.add('hidden');
            } else {
                employerFields.classList.add('hidden');
                jobSeekerFields.classList.remove('hidden');
            }
        });

        // Initialize the visibility based on the default role
        if (roleSelect.value === '1') {
            employerFields.classList.remove('hidden');
            employerFields.classList.add('hidden2');
        }
    </script>
</x-layout>
