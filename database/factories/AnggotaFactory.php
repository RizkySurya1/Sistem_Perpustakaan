<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnggotaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'alamat' => fake()->address(),
            'no_hp' => fake()->numerify('08##########'),
            'tanggal_daftar' => fake()->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
