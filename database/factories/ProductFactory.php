<?php

namespace Database\Factories;

use App\Models\Category;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Nama barang Indonesia
        $namaBarang = $this->faker->randomElement([
            'Pulpen Faster',
            'Buku Tulis Sidu',
            'Kertas HVS A4',
            'Pulpen Standard',
            'Kabel Data Vivan',
            'Voucher Telkomsel',
            'Voucher Indosat',
            'Flashdisk Sandisk',
            'Mouse Logitech',
            'Headset JBL',
            'Stabilo Warna',
            'Amplop Coklat',
            'Pulpen Gel Pilot',
            'Buku Gambar',
            'Kalkulator Casio'
        ]);



        // Cost price dulu
        $cost = $this->faker->numberBetween(500, 50000);

        return [
            'name' => $namaBarang,
            'product_code' => rand(1000, 999999) . date('His'),
            'cost_price' => $cost,
            'price' => $this->faker->numberBetween($cost + 500, $cost + 50000),
            'image' => 'dummy-image.png',
            'category_id' => Category::inRandomOrder()->first()->id,
            'stock' => $this->faker->numberBetween(1, 100),
            'barcode' => rand(10, 999) . date('His'),
            'description' => $this->faker->sentence(),
        ];
    }
}
