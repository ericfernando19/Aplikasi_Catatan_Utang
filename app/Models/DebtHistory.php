<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtHistory extends Model
{
    use HasFactory;

    protected $fillable = ['debt_id', 'jumlah', 'tanggal'];

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}
