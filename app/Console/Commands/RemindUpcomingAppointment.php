<?php

namespace App\Console\Commands;

use App\Models\Inquiry;
use App\Services\FirebaseCloudMessage;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class RemindUpcomingAppointment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send appointment reminders 10 minutes before appointment time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Inquiry::whereNotNull('service_id')
            ->whereRelation('invoice', 'paid', true)
            ->where('is_reminder_sent', false)
            ->whereBetween('appointment_datetime', [
                now(),
                now()->addMinutes(10),
            ])->chunkById(100, function ($appointments) {
                // Send notifications for qualifying appointments
                foreach ($appointments as $appointment) {
                    $this->info("Inquiry #{$appointment->id} Notification sending...");

                    $appointment_time = Carbon::parse($appointment->appointment_datetime)->format('h:i A');
                    $dateDescription = Carbon::parse($appointment->appointment_datetime)->isToday() ? 'today' : 'tomorrow';
                    $title = "Upcoming Appointment ({$appointment->service->title})";
                    $message = "Your appointment is scheduled at {$dateDescription} {$appointment_time}.";
                    $this->sendNotification($title, $message, $appointment->user->fcm_token, $appointment);
                    $this->sendNotification($title, $message, $appointment->service->user->fcm_token, $appointment);
                }
            });


        $this->info('Notifications sent successfully.');

        return CommandAlias::SUCCESS;
    } // Function to send notification

    private function sendNotification($title, $message, $fcm_token, Inquiry $appointment)
    {
        // Initialize FCM client
        $fcmClient = new FirebaseCloudMessage;
        $isSent = $fcmClient->sendPushNotification(
            title: $title,
            body: $message,
            routeName: "inquiries/view/{$appointment->id}",
            deviceToken: $fcm_token,
        );
        if ($isSent) {
            $appointment->update(['is_reminder_sent' => true]);
        }
    }
}
