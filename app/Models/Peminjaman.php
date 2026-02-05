<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peminjamans';
    protected $guarded = [];

    protected $casts = [
        'tanggal_peminjaman' => 'date',
        'tanggal_pengembalian_direncanakan' => 'date',
        'tanggal_pengembalian_aktual' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function disetujuiOleh()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'disetujui';
    }

    public function isReturned()
    {
        return $this->status === 'dikembalikan';
    }

    public function isRejected()
    {
        return $this->status === 'ditolak';
    }
}
