@component('mail::message')
<p>You were set as an agent for the online support platform by the admin. Following are the credentials.</p>
<ul>
    <li>Name: {{ $name }}</li>
    <li>Email: {{ $email }}</li>
    <li>Password: {{ $password }}</li>
</ul>

@component('mail::button', ['url' => route('login_home')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
