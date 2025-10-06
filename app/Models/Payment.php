<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['debt_id', 'jumlah', 'tanggal'];

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}
