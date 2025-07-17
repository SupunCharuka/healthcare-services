<x-mail::message>

<div style="text-align: center; padding: 20px;">
<img src="https://healthcare.lk/img/logo3.png" alt="{{ config('app.name') }} Logo" style="max-width: 150px;">
</div>

<p>Hello, {{ $inquiry->name }},</p>

<p>We have received your request for the "{{ $serviceCategory->name }}" service.</p>

<p>Your inquiry ID: <strong>#{{ $inquiry->id }}</strong>. </p>
<p>Your inquiry was submitted on: {{ $inquiry->created_at->format('Y-m-d H:i:s') }}.</p>
<p>Your phone number: {{ $inquiry->phone }}.</p>

<p>We will review your request and get back to you as soon as possible.</p>

<p>Thank you!</p>

<x-mail::button :url="config('app.url')">
        Continue
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
