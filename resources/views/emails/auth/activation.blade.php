@component('mail::message')
# Aktivacija naloga

Hvala što ste se registrovali. Molimo Vas aktivirajte Vaš nalog.

@component('mail::button', ['url' => route('auth.activate', [
    'token' => $user->activation_token,
    'email' => $user->email
    ])])
    Aktiviraj
@endcomponent

Hvala,<br>
{{ config('app.name') }}
@endcomponent
