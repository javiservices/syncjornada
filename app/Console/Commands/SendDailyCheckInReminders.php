<?php

namespace App\Console\Commands;

use App\Mail\DailyCheckInReminder;
use App\Models\Company;
use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDailyCheckInReminders extends Command
{
    protected $signature = 'reminders:daily-checkin';
    protected $description = 'Send daily check-in reminders to employees who have not checked in yet';

    public function handle()
    {
        $today = now()->toDateString();
        
        // Get all companies with check-in notifications enabled
        $companies = Company::where('enable_checkin_notifications', true)->get();
        
        foreach ($companies as $company) {
            // Set timezone for this company
            $timezone = $company->timezone ?? 'Europe/Madrid';
            $now = Carbon::now($timezone);
            
            // Get the configured notification time
            $notificationTime = $company->checkin_notification_time ?? '08:00:00';
            list($hour, $minute) = explode(':', $notificationTime);
            
            // Check if current time matches the notification time (with 5 min tolerance)
            if ($now->hour == $hour && $now->minute >= $minute && $now->minute < ($minute + 5)) {
                
                // Get all active employees from this company
                $employees = User::where('company_id', $company->id)
                    ->whereIn('role', ['employee', 'manager'])
                    ->get();
                
                foreach ($employees as $employee) {
                    // Check if employee has already checked in today
                    $hasCheckedIn = TimeEntry::where('user_id', $employee->id)
                        ->whereDate('date', $today)
                        ->whereNotNull('check_in')
                        ->exists();
                    
                    // Only send reminder if they haven't checked in
                    if (!$hasCheckedIn) {
                        try {
                            Mail::to($employee->email)->send(new DailyCheckInReminder($employee));
                            $this->info("Reminder sent to {$employee->email} ({$company->name})");
                        } catch (\Exception $e) {
                            $this->error("Failed to send reminder to {$employee->email}: {$e->getMessage()}");
                        }
                    }
                }
            }
        }
        
        return 0;
    }
}
