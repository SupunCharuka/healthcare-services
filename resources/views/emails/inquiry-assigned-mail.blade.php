<x-mail::message>

<div style="text-align: center; padding: 20px;">
<img src="https://healthcare.lk/img/logo3.png" alt="{{ config('app.name') }} Logo" style="max-width: 150px;">
</div>

<h1>Inquiry Assigned</h1>

<p>Hello {{ $inquiry->service->user->name }},</p>

<p>An inquiry has been assigned to you with the following details:</p>

<ul>
<li>Inquiry Id: #{{ $inquiry->id }}</li>
<li>Service Name: {{ $inquiry->serviceCategory->name }}</li>
<li>Customer Name: {{ $inquiry->name }}</li>
<li>Cutomer Email: {{ $inquiry->email }}</li>
<li>Cutomer Phone Number: {{ $inquiry->phone }}</li>
<li>Invoice Amount: LKR {{ number_format($inquiry->cost, 2) }}</li>
</ul>

<p>Thank you for your service!</p>

<x-mail::button :url="config('app.url')">
Continue
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
