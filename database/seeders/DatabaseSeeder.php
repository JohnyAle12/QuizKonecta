<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\Category::factory()->create(['name' => 'Panadería']);
        \App\Models\Category::factory()->create(['name' => 'Bebidas frías']);
        \App\Models\Category::factory()->create(['name' => 'Bebidas Calientes']);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
