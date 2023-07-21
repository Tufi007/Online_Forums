<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckAccountDeletionRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-account-deletion-requests';

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
        $tenDaysAgo = now()->subDays(10);

        // Get the users whose deletion request is older than 10 days
        $usersToDelete = User::where('delete_requested_at', '<=', $tenDaysAgo)->get();

        foreach ($usersToDelete as $user) {
            // Delete the user account and any associated data here
            // (e.g., delete related posts, comments, etc.)

            $user->delete();
        }
    }
}
