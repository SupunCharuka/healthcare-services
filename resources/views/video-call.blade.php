<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Meeting</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #videoCallContainer {
            width: 100%;
            height: calc(100vh - 100px);
            max-height: max-content;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <main>
        <!-- Video Call Container -->
        <div id="videoCallContainer"></div>
    </main>
    <!-- Include ZEGO UI Kit Prebuilt library -->
    <script src="{{ asset('assets/backend/js/jquery-3.6/jquery-3.6.0.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@zegocloud/zego-uikit-prebuilt/zego-uikit-prebuilt.js"></script>

    <!-- Your JavaScript Code -->
    <script>
        $(document).ready(function() {
            startVideoCall();
        });

        function startVideoCall() {

            const appID = {{ config('app.zego.app_id') }};
            const serverSecret = "{{ config('app.zego.server_secret') }}";
            const roomID = "{{ $roomID }}";
            const inquieyID = "{{ $inquiryDetail->id }}";
            let  userID = "{{ Auth::check() ? Auth::user()->id : '' }}";
            let  userName = "{{ Auth::check() ? Auth::user()->name : 'Guest' }}" + userID;
            if (!userID) {
                userID = Math.floor(Math.random() * 10000) + "";
                userName = "Guest" + userID;
            }
            const kitToken = ZegoUIKitPrebuilt.generateKitTokenForTest(appID, serverSecret, roomID, userID, userName);

            const zp = ZegoUIKitPrebuilt.create(kitToken);

            zp.joinRoom({
                container: document.getElementById('videoCallContainer'),
                scenario: {
                    mode: ZegoUIKitPrebuilt.OneONoneCall,
                },
                turnOnMicrophoneWhenJoining: true,
                turnOnCameraWhenJoining: true,
                showMyCameraToggleButton: true,
                showMyMicrophoneToggleButton: true,
                showAudioVideoSettingsButton: true,
                showScreenSharingButton: true,
                showTextChat: true,
                showUserList: true,
                maxUsers: 2,
                layout: "Auto",
                showLayoutButton: false,
            });
        }
    </script>
</body>

</html>
