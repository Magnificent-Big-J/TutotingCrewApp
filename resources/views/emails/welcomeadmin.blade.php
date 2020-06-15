@component('mail::message')
    #My Tutoring Crew Administrator

    Welcome, {{$user->name}}.

    We are very please that you can be part of the family.
    Please find your temporarily login credentials.
    username/email: {{$user->email}}
    password: {{$user->temp_password}}
    Make sure you change your login credentials using the below link.

    @component('mail::button', ['url' => 'password/reset'])
        Reset Password
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
