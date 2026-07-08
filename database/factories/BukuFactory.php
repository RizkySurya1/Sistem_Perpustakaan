<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_kategori' => Kategori::inRandomOrder()->first()?->id_kategori ?? Kategori::factory(),
            'judul' => ucwords(fake()->words(3, true)),
            'pengarang' => fake()->name(),
            'penerbit' => fake()->company(),
            'tahun_terbit' => fake()->year(),
            'stok' => fake()->numberBetween(1, 20),
            'cover' => null,
        ];
    }
}
