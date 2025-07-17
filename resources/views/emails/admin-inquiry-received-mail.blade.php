<x-mail::message>

<div style="text-align: center; padding: 20px;">
<img src="https://healthcare.lk/img/logo3.png" alt="{{ config('app.name') }} Logo" style="max-width: 150px;">
</div>

<p>Hello Admin,</p>

<p>A new inquiry has been received with the following details:</p>

<ul>
<li>Customer Name: {{ $inquiry->name }}</li>
<li>Inquiry ID: #{{ $inquiry->id }}</li>
<li>Service Name: {{ $serviceCategory->name }}</li>
<li>Created Date: {{ $inquiry->created_at->format('Y-m-d H:i:s') }}</li>
</ul>

<p>Thank you!</p>

<x-mail::button :url="config('app.url')">
        Continue
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
