<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_pinjam';
    protected $fillable = [
        'id_anggota', 'id_user', 'tanggal_pinjam', 'tanggal_kembali', 'status',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function detail()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_pinjam', 'id_pinjam');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'id_pinjam', 'id_pinjam');
    }

    // many-to-many bridge: books borrowed in this transaction
    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'detail_peminjaman', 'id_pinjam', 'id_buku')
            ->withPivot('jumlah');
    }
}
