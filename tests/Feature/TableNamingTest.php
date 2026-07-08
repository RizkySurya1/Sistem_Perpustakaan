<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TableNamingTest extends TestCase
{
    use RefreshDatabase;

    public function test_expected_singular_tables_exist(): void
    {
        $this->assertTrue(Schema::hasTable('kategori'));
        $this->assertTrue(Schema::hasTable('buku'));
        $this->assertTrue(Schema::hasTable('anggota'));
        $this->assertTrue(Schema::hasTable('peminjaman'));
        $this->assertTrue(Schema::hasTable('detail_peminjaman'));
        $this->assertTrue(Schema::hasTable('pengembalian'));
    }
}
