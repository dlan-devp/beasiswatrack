<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'nama_role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin111'),
            'kode_role' => Role::where('nama_role', 'admin')->value('kode_role'),
        ]);

        // Create sample scholarships
        Scholarship::factory(12)->create();
    }
}

