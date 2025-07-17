<x-mail::message>
    
<div style="text-align: center; padding: 20px;">
<img src="https://healthcare.lk/img/logo3.png" alt="{{ config('app.name') }} Logo" style="max-width: 150px;">
</div>

<h2>Meeting Invitation</h2>

<p>Hello,{{$inquiryDetails->name}}</p>

<p>You are invited to a meeting. Please click the link below to join the meeting:</p>

<x-mail::button :url="$meetingLink">
Join Meeting
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
