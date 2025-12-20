<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteUnverifiedAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete-unverified-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete users who did not verified their email address';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::where('email_verified_at', null)->where('created_at', '<', now()->subHour())->delete();
    }
}
