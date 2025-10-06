<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        $query = Debt::where('user_id', auth()->id());

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('keterangan', 'like', '%' . $request->search . '%');
            });
        }

        $debts = $query->get();

        return view('debts.index', compact('debts'));
    }



    public function create()
    {
        return view('debts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // otomatis simpan user_id sesuai user login
        $validated['user_id'] = auth()->id();

        // default status belum lunas (0)
        $validated['status'] = 0;

        Debt::create($validated);

        return redirect()->route('debts.index')->with('success', 'Utang berhasil ditambahkan');
    }


    // === INI METHOD YANG DIPERLUKAN (show) ===
    public function show(Debt $debt)
    {
        // pastikan payments ter-load
        $debt->load('payments');
        return view('debts.show', compact('debt'));
    }

    public function edit(Debt $debt)
    {
        return view('debts.edit', compact('debt'));
    }

    public function update(Request $request, Debt $debt)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'status' => 'sometimes|in:0,1',
        ]);

        $debt->update($data);

        return redirect()->route('debts.index')->with('success', 'Catatan utang berhasil diperbarui.');
    }

    public function destroy(Debt $debt)
    {
        $debt->delete();
        return redirect()->route('debts.index')->with('success', 'Catatan utang berhasil dihapus.');
    }

    // route untuk menandai lunas cepat (opsional)
    public function markAsPaid(Debt $debt)
    {
        $debt->update(['status' => 1]);
        return redirect()->route('debts.index')->with('success', 'Utang sudah ditandai lunas.');
    }
    public function addDebt(Request $request, Debt $debt)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
        ]);

        // tambahkan jumlah utang baru
        $debt->jumlah = ($debt->jumlah ?? 0) + $request->input('jumlah');

        // update status: default 0 (belum lunas)
        $debt->status = 0;
        $debt->save();

        // ✅ simpan riwayat tambah utang ke debt_histories
        $debt->histories()->create([
            'jumlah' => $request->input('jumlah'),
            'tanggal' => now(),
        ]);

        return redirect()->route('debts.show', $debt->id)
            ->with('success', 'Utang baru berhasil ditambahkan ke akun ini.');
    }





}
