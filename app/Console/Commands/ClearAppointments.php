<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Calculate the date one month ago
        $oneMonthAgo = Carbon::now()->subMonth();

        // Delete appointments older than one month
        Appointment::where('created_at', '<', $oneMonthAgo)->delete();

        $this->info('Appointments older than one month have been cleared.');
    }
}
