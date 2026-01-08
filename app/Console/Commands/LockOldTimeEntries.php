<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TimeEntry;
use Carbon\Carbon;

class LockOldTimeEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timeentries:lock-old {--years=4 : Number of years to retain before locking}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lock time entries older than specified years for legal compliance (default 4 years)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $years = $this->option('years');
        $cutoffDate = Carbon::now()->subYears($years);

        $this->info("Locking time entries older than {$cutoffDate->toDateString()}...");

        $count = TimeEntry::where('is_locked', false)
            ->where('created_at', '<', $cutoffDate)
            ->update(['is_locked' => true]);

        $this->info("Locked {$count} time entries.");

        return 0;
    }
}
