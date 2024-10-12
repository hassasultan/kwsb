<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Find the user you want to make an admin
        $adminUser = User::find('1'); // Replace with your admin's email

        if ($adminUser) {
            // Assign the Admin role to the user
            $adminUser->assignRole($adminRole);
        }
    }
}
