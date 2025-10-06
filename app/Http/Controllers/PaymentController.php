<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, Debt $debt)
    {
        $data = $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
        ]);

        // simpan cicilan
        $data['debt_id'] = $debt->id;
        Payment::create($data);

        // refresh data biar accessor ke-update
        $debt->refresh();

        // cek sisa utang, kalau 0 atau kurang → set status lunas
        if ($debt->sisa_utang <= 0) {
            $debt->update(['status' => 1]);
        }

        return redirect()->route('debts.show', $debt->id)
            ->with('success', 'Pembayaran berhasil dicatat.');
    }

}
