<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_counts_late_returns_with_denda(): void
    {
        $user = User::create([
            'nama' => 'Admin Test',
            'username' => 'admintest',
            'email' => 'admintest@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);
        $anggota = Anggota::factory()->create();
        Buku::factory()->create();

        $peminjaman = Peminjaman::create([
            'id_anggota' => $anggota->id_anggota,
            'id_user' => $user->id_user,
            'tanggal_pinjam' => now()->subDays(10)->toDateString(),
            'tanggal_kembali' => now()->subDays(2)->toDateString(),
            'status' => 'dipinjam',
        ]);

        Pengembalian::create([
            'id_pinjam' => $peminjaman->id_pinjam,
            'tanggal_dikembalikan' => now()->toDateString(),
            'denda' => 2000,
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('1 transaksi');
        $response->assertSee('Total Denda: Rp 2.000');
    }
}
