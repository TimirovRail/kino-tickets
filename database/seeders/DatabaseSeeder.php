<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([ // Используем массив для более чистой записи
            EventSeeder::class,
            AdminUserSeeder::class,
            SeatsTableSeeder::class, // Добавляем вызов SeatsTableSeeder
            ExhibitsTableSeeder::class,
            EpochSeeder::class,
           
        ]);
    }
}