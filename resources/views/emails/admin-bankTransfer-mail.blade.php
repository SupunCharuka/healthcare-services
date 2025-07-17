<x-mail::message>

<div style="text-align: center; padding: 20px;">
<img src="https://healthcare.lk/img/logo3.png" alt="{{ config('app.name') }} Logo" style="max-width: 150px;">
</div>

<h2>Bank Transfer Notification</h2>

<p>Hello Admin,</p>

<p>A bank transfer has been initiated with the following details:</p>

<ul>
<li>Invoice ID : <strong>#{{ str_pad($invoice->id, 6, 0, STR_PAD_LEFT) }}</strong></li>
<li>Inquiry ID : <strong>#{{ str_pad($invoice->inquiry->id, 6, 0, STR_PAD_LEFT) }}</strong></li>
<li>Amount : <strong>LKR {{ number_format($invoice->amount, 2)}}</strong></li>
<li>Customer Name : <strong>{{ $invoice->inquiry->name }}</strong></li>
<li>Date of issue of the enquire : <strong>{{ $invoice->inquiry->created_at->format('M d, Y') }}</strong></li>
<li>Type of Inquiry : <strong>{{ $invoice->inquiry->serviceCategory->name }}</strong></li>
<li>Payment Type : <strong>Bank Transfer</strong></li>
<li>Comment: <strong>{{ $invoice->comment ?? 'No comment provided' }}</strong></li>
</ul>

<p>Please review the details and take the necessary actions.</p>

<x-mail::button :url="config('app.url')">
Continue
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
