<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\DailyCheckInReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    protected $signature = 'test:email {email}';
    protected $description = 'Test sending email to a specific user';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found");
            return 1;
        }

        $this->info("Sending test email to: {$user->name} ({$user->email})");
        $this->info("Company: {$user->company->name}");

        try {
            Mail::to($user->email)->send(new DailyCheckInReminder($user, $user->company));
            $this->info("✓ Email sent successfully!");
            return 0;
        } catch (\Exception $e) {
            $this->error("✗ Failed to send email: " . $e->getMessage());
            return 1;
        }
    }
}
