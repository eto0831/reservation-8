<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use App\Mail\ReservationReminderMail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
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
                Log::info('SendDailyReminderEmails: Sending email for reservation ID ' . $reservation->id);

                // 直接メールを送信
                Mail::to($reservation->user->email)
                    ->send(new ReservationReminderMail($reservation));

                Log::info('SendDailyReminderEmails: Email sent successfully for reservation ID ' . $reservation->id);
            } catch (\Exception $e) {
                Log::error('SendDailyReminderEmails: Failed to send email for reservation ID ' . $reservation->id . '. Error: ' . $e->getMessage());
            }
        }

        $this->info('Reminder emails sent successfully.');
        Log::info('SendDailyReminderEmails: Command execution completed.');
    }
}
