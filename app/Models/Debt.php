<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = ['nama', 'jumlah', 'keterangan', 'tanggal', 'status', 'user_id'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // total bayar (akses via $debt->total_bayar)
    public function getTotalBayarAttribute()
    {
        // jika payments belum di-load, akan query; jika sudah, pakai collection
        return $this->payments->sum('jumlah');
    }

    // sisa utang (akses via $debt->sisa_utang)
    public function getSisaUtangAttribute()
    {
        return $this->jumlah - $this->total_bayar;
    }
    public function histories()
    {
        return $this->hasMany(DebtHistory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
