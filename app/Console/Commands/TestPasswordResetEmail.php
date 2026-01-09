<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class TestPasswordResetEmail extends Command
{
    protected $signature = 'test:password-reset {email}';
    protected $description = 'Test password reset email sending';

    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }
        
        $this->info("Sending password reset email to: {$email}");
        
        $status = Password::sendResetLink(['email' => $email]);
        
        if ($status === Password::RESET_LINK_SENT) {
            $this->info("✓ Password reset email sent successfully!");
            return 0;
        } else {
            $this->error("✗ Failed to send password reset email. Status: {$status}");
            return 1;
        }
    }
}
