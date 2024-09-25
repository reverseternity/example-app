<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Чтобы не вызывать каждый кастомный сидер по отдельности, т.к. sail artisan db:seed работает только с файлом DatabaseSeeder,
        // здесь прописывается вызов собственного метода родительского класса Seeder - call(), в который передается массив с экземплярами
        // классов кастомных сидеров. Таким образом, при выполнении команды db:seed будут выполняться наши кастомные сиды.
        $this->call([
           FormSeeder::class
        ]);
    }
}
