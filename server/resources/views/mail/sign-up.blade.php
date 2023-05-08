<x-mail::message>
# Sign Up

Verify your account by clicking the button below.

<x-mail::button :url="$url">
Verify
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<style>

</style>