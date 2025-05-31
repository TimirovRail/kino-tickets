<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Запускает создание администратора.
     *
     * @return void
     */
    public function run(): void
    {
        // Проверяем, существует ли администратор с таким email
        if (!User::where('email', env('ADMIN_EMAIL', 'admin@example.com'))->exists()) {
            // Создаем администратора
            User::create([
                'name' => env('ADMIN_NAME', 'Admin User'), // Используем значение из .env или значение по умолчанию
                'email' => env('ADMIN_EMAIL', 'admin@example.com'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
                'is_admin' => true,
            ]);
        }
    }
}