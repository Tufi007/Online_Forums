<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Admin;

class PromoteUsersToAdmin extends Command
{
    protected $signature = 'promotion:usersToAdmin';
    protected $description = 'Promote users to admin if they meet the criteria.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $questionCount = $user->questions->count();
            $answerCount = $user->answers->count();

            if ($questionCount >= 100 && $answerCount >= 500) {
                // Check if the user is not already an admin
                if (!$user->isAdmin()) {
                    Admin::create([
                        'user_id' => $user->id,
                        'is_admin' => true,
                    ]);
                }
            }
        }

        $this->info('Users have been promoted to admins as per criteria.');
    }
}
