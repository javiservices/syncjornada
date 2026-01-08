<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\TimeEntry;
use App\Mail\MissingCheckOutReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendMissingCheckOutReminders extends Command
{
    protected $signature = 'reminders:missing-checkout';
    protected $description = 'Send checkout reminders to employees who have not checked out yet';

    public function handle()
    {
        $companies = Company::where('enable_checkout_notifications', true)->get();

        foreach ($companies as $company) {
            $timezone = $company->timezone ?? config('app.timezone');
            $now = Carbon::now($timezone);
            $notificationTime = Carbon::parse($company->checkout_notification_time, $timezone);

            $shouldSend = $now->hour === $notificationTime->hour && 
                         $now->minute >= $notificationTime->minute && 
                         $now->minute < ($notificationTime->minute + 5);

            if (!$shouldSend) {
                continue;
            }

            $openEntries = TimeEntry::whereDate('date', $now->toDateString())
                ->whereNotNull('check_in')
                ->whereNull('check_out')
                ->whereHas('user', function ($query) use ($company) {
                    $query->where('company_id', $company->id);
                })
                ->with('user')
                ->get();

            foreach ($openEntries as $entry) {
                $user = $entry->user;
                try {
                    Mail::to($user->email)->send(new MissingCheckOutReminder($user, $company));
                    $this->info("Checkout reminder sent to {$user->name} ({$user->email}) from {$company->name}");
                } catch (\Exception $e) {
                    $this->error("Failed to send checkout reminder to {$user->email}: " . $e->getMessage());
                }
            }
        }

        $this->info('Missing checkout reminders processed successfully.');
        return 0;
    }
}
