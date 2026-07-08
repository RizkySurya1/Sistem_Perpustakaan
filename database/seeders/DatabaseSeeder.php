<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@perpus.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Petugas Perpustakaan',
            'username' => 'petugas',
            'email' => 'petugas@perpus.test',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        // Kategori master data
        $kategoris = ['Fiksi', 'Non-Fiksi', 'Sains', 'Sejarah', 'Teknologi', 'Agama', 'Komik', 'Biografi'];
        foreach ($kategoris as $k) {
            Kategori::create(['nama_kategori' => $k]);
        }

    }
}
