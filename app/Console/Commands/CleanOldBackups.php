<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class CleanOldBackups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:clean {--days=30 : Number of days to keep backups}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete database backups older than specified days (default: 30)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->option('days');
        $this->info("Cleaning backups older than {$days} days...");

        $backupDir = storage_path('app/backups');
        
        if (!file_exists($backupDir)) {
            $this->info('No backup directory found.');
            return Command::SUCCESS;
        }

        $files = glob($backupDir . '/backup_*.sql');
        $cutoffDate = Carbon::now()->subDays($days);
        $deletedCount = 0;
        $deletedSize = 0;

        foreach ($files as $file) {
            $fileTime = Carbon::createFromTimestamp(filemtime($file));
            
            if ($fileTime->lt($cutoffDate)) {
                $size = filesize($file);
                if (unlink($file)) {
                    $deletedCount++;
                    $deletedSize += $size;
                    $this->info('Deleted: ' . basename($file));
                }
            }
        }

        $deletedSizeMB = round($deletedSize / 1024 / 1024, 2);
        $this->info("Cleaned {$deletedCount} backup(s), freed {$deletedSizeMB} MB");
        
        return Command::SUCCESS;
    }
}
