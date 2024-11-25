<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use App\Jobs\SendReminderEmailJob; // ここが必要、直接送信の場合はJobでなくMailを指定。
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendDailyReminderEmails extends Command
{
    protected $signature = 'emails:send-reminders';
    protected $description = 'Send reminder emails to users with reservations for today';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now()->toDateString();
        Log::info('SendDailyReminderEmails: Fetching reservations for ' . $today);

        $reservations = Reservation::whereDate('reserve_date', $today)->get();

        if ($reservations->isEmpty()) {
            Log::info('SendDailyReminderEmails: No reservations found for today.');
        }

        foreach ($reservations as $reservation) {
            try {
                // ジョブをディスパッチして非同期的にメールを送信
                SendReminderEmailJob::dispatch($reservation);

                Log::info('SendDailyReminderEmails: Job dispatched for reservation ID ' . $reservation->id);
            } catch (\Exception $e) {
                Log::error('SendDailyReminderEmails: Failed to dispatch job for reservation ID ' . $reservation->id . '. Error: ' . $e->getMessage());
            }
        }

        $this->info('Reminder email jobs dispatched successfully.');
        Log::info('SendDailyReminderEmails: Command execution completed.');
    }
}
