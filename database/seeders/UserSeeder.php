<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new \App\Models\User();
        $admin->first_name = 'Benjamin';
        $admin->last_name = 'Ayo';
        $admin->email = 'benayo71@gmail.com';
        $admin->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; # password
        $admin->save();

        $admin->ownedTeams()->save(\App\Models\Team::forceCreate([
            'user_id' => $admin->id,
            'name' => 'Admins Team',
            'personal_team' => true,
        ]));
    }
}