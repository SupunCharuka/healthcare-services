<x-mail::message>

<div style="text-align: center; padding: 20px;">
<img src="https://healthcare.lk/img/logo3.png" alt="{{ config('app.name') }} Logo" style="max-width: 150px;">
</div>

Hello Admin,

An inquiry has been marked as completed with the following details:
    
- Service Name: {{ $memberInquiryService->serviceCategory->name }}.
- Inquiry ID: #{{ $memberInquiryService->id }}.
- Customer Name: {{ $memberInquiryService->name }}.
- Cutomer Email: {{ $memberInquiryService->email }}.
- Cutomer Phone: {{ $memberInquiryService->phone }}.
    
Thank you for your attention!

Regards,<br>
<strong>{{$memberInquiryService->service->user->name }}</strong> 

<x-mail::button :url="config('app.url')">
Continue
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
