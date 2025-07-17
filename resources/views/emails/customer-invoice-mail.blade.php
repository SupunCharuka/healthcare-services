<x-mail::message>

<div style="text-align: center; padding: 20px;">
<img src="https://healthcare.lk/img/logo3.png" alt="{{ config('app.name') }} Logo" style="max-width: 150px;">
</div>
Hello {{ $inquiry->name }},

An invoice has been created for your inquiry with the following details:

- Inquiry Id: #{{ $inquiry->id }}
- Service Name: {{ $inquiry->serviceCategory->name }}
- Phone: {{ $inquiry->phone }}
- Invoice Amount: LKR {{ number_format($invoiceAmount, 2) }}
- Created Date: {{ $inquiry->invoice->created_at->format('M d, Y h:i A') }}
@if ($inquiry->service_id)
- Name of the persion to meet: {{ $inquiry->service->user->name }}
@endif

Thank you for your business!

<x-mail::button :url="$invoiceLink">
Payment Invoice
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
