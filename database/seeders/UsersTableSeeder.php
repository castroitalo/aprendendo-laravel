<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Users table seeder
 *
 * @package Database\Seeders
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create multiple users
        DB::table('users')->insert([
            [
                'username'   => 'user1@gmail.com',
                'password'   => password_hash('1234567890', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username'   => 'user2@gmail.com',
                'password'   => password_hash('1234567890', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username'   => 'user3@gmail.com',
                'password'   => password_hash('1234567890', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
