<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Enums\UserStatuses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'email' => 'admin@admin',
            'password' => '$2y$10$C.I4cmAVURQEiC4tQ/8oDuH2fIjA7sOarLWRb2UHYLv38Bk7BOiWu', // admin1234
            'role' => UserRoles::ADMIN,
            'status' => UserStatuses::ACTIVE,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now()
        ];

        $admin = User::where('email', $data['email'])->first();
        if (!$admin) {
            User::create($data);
        }
    }
}
