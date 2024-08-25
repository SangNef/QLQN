<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $departments = [
            'A1',
            'A2',
            'A3',
            'A4',
            'A6',
            'A7',
            'A10',
            'A12',
            'A14',
            'B1',
            'B3',
            'B5',
            'B7',
            'B8',
            'B9',
            'B11',
            'C1',
            'C2',
            'C6',
            'C8',
            'C9',
            'C10',
            'C11',
            'C12',
            'Ban Giám đốc',
            'Ban Hành chính',
            'Ban Chính trị',
            'Ban Hậu cần',
            'Ban KHTH',
            'Ban YTĐD',
            'Ban Tang lễ',
            'Bộ phận CNTT',
            'Bộ phận CTXH'
        ];

        foreach ($departments as $department) {
            DB::table('departments')->insert([
                'name' => $department,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('roles')->insert([
            [
                'type' => '1',
                'name' => 'SuperVip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => '2',
                'name' => 'Thủ trưởng Ban Hậu cần',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => '2',
                'name' => 'Thủ trưởng Ban Giám đốc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => '3',
                'name' => 'Trợ lý Doanh trại',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => '4',
                'name' => 'Hành chính',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => '4',
                'name' => 'Quản lý kho',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('users')->insert([
            'name' => 'SuperAdmin',
            'username' => 'SuperAdmin',
            'password' => 'admin123',
            'role_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('storages')->insert([
            [
                'name' => 'Kho A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kho B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kho C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kho D',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
