@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-plus-circle me-2"></i>
                    <h5 class="mb-0">Tambah Catatan Utang</h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('debts.store') }}" method="POST">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-person-circle me-1 text-primary"></i> Nama
                            </label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama pengutang" required>
                        </div>

                        {{-- Jumlah --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-cash-coin me-1 text-success"></i> Jumlah
                            </label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah utang" required>
                        </div>

                        {{-- Tanggal --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-calendar-date me-1 text-warning"></i> Tanggal
                            </label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        {{-- Keterangan --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-card-text me-1 text-info"></i> Keterangan
                            </label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Tulis keterangan tambahan..."></textarea>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('debts.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
