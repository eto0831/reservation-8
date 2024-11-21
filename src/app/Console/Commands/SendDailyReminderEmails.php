<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use App\Jobs\SendReminderEmailJob;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendDailyReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to users with reservations for today';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->toDateString();

        $reservations = Reservation::whereDate('reserve_date', $today)->get();

        foreach ($reservations as $reservation) {
            SendReminderEmailJob::dispatch($reservation);
        }

        $this->info('Reminder emails dispatched successfully.');
    }
}
