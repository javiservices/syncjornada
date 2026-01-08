<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a backup of the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database backup...');

        // Backup directory
        $backupDir = storage_path('app/backups');
        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        // Backup filename with timestamp
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filepath = $backupDir . '/' . $filename;

        // Database credentials from .env
        $dbHost = config('database.connections.mysql.host');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        // Create backup using mysqldump directly from host to db container
        // Using PDO to dump the database
        try {
            $pdo = new \PDO(
                "mysql:host={$dbHost};dbname={$dbName}",
                $dbUser,
                $dbPass,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );

            $tables = [];
            $result = $pdo->query('SHOW TABLES');
            while ($row = $result->fetch(\PDO::FETCH_NUM)) {
                $tables[] = $row[0];
            }

            $dump = "-- MySQL dump\n";
            $dump .= "-- Host: {$dbHost}    Database: {$dbName}\n";
            $dump .= "-- ------------------------------------------------------\n";
            $dump .= "-- Server version\n\n";
            $dump .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                // Drop table
                $dump .= "DROP TABLE IF EXISTS `{$table}`;\n";
                
                // Create table
                $createTable = $pdo->query("SHOW CREATE TABLE `{$table}`")->fetch();
                $dump .= $createTable[1] . ";\n\n";
                
                // Insert data
                $rows = $pdo->query("SELECT * FROM `{$table}`");
                while ($row = $rows->fetch(\PDO::FETCH_ASSOC)) {
                    $values = array_map(function($value) use ($pdo) {
                        return $value === null ? 'NULL' : $pdo->quote($value);
                    }, array_values($row));
                    $dump .= "INSERT INTO `{$table}` VALUES (" . implode(',', $values) . ");\n";
                }
                $dump .= "\n";
            }

            $dump .= "SET FOREIGN_KEY_CHECKS=1;\n";

            file_put_contents($filepath, $dump);

            if (file_exists($filepath) && filesize($filepath) > 0) {
                $size = round(filesize($filepath) / 1024 / 1024, 2);
                $this->info("Backup created successfully: {$filename} ({$size} MB)");
                return Command::SUCCESS;
            }

            $this->error('Backup file is empty!');
            return Command::FAILURE;

        } catch (\Exception $e) {
            $this->error('Backup failed: ' . $e->getMessage());
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            return Command::FAILURE;
        }
    }
}
