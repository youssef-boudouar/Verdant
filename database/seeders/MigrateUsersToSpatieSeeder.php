<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class MigrateUsersToSpatieSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->role === 'admin') {
                $user->assignRole('admin');
                echo "✅ {$user->name} → admin role\n";
            } elseif ($user->role === 'client') {
                $user->assignRole('client');
                echo "✅ {$user->name} → client role\n";
            }
        }

        echo "\n✅ Migration complete!\n\n";
    }
}
