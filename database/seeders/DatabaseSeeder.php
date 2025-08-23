<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('123'),
            'role' => 'admin'
        ]);

        Category::factory()->create([
            'name' => 'Buku',
        ]);
        Category::factory()->create([
            'name' => 'Voucher',
        ]);
        Category::factory()->create([
            'name' => 'Elektronik',
        ]);
        Category::factory()->create([
            'name' => 'Alat Tulis',
        ]);
        Category::factory()->create([
            'name' => 'Aksesoris',
        ]);
        Category::factory()->create([
            'name' => 'Alat Tulis Kantor',
        ]);
        Category::factory()->create([
            'name' => 'Voucher Paket',
        ]);
        Category::factory()->create([
            'name' => 'Game',
        ]);
        Category::factory()->create([
            'name' => 'Kategori Lainnya',
        ]);
        // Product::factory(50)->create();
    }
}
