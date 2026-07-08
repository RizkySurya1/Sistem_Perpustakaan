<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_kategori' => fake()->unique()->randomElement([
                'Fiksi', 'Non-Fiksi', 'Sains', 'Sejarah', 'Teknologi', 'Agama', 'Komik', 'Biografi',
            ]),
        ];
    }
}
