<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\FirebaseCloudMessage;
use Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class SendBirthdayWishes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wish:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday wishes to users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fcmClient = new FirebaseCloudMessage;
        User::whereMonth('dob', Carbon::now()->month)
            ->whereDay('dob', Carbon::now()->day)
            ->chunkById(100, function ($users) use ($fcmClient) {
                foreach ($users as $user) {
                    $fcmClient->sendPushNotification(
                        title: "Happy Birthday!",
                        body: "Happy Birthday, {$user->name}! Have a fantastic day! 🎉",
                        routeName: "",
                        deviceToken: $user->fcm_token
                    );
                }
            });


        $this->info('Birthday wishes sent successfully!');
        return CommandAlias::SUCCESS;
    }
}
