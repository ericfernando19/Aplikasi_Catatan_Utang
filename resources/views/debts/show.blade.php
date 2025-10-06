@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- ✅ Card Detail Utang --}}
            <div class="card shadow-lg border-0 rounded-3 mb-4">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    <h5 class="mb-0">Detail Catatan Utang</h5>
                </div>

                <div class="card-body">
                    {{-- Alert sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong><i class="bi bi-person-circle text-primary me-2"></i> Nama:</strong> {{ $debt->nama }}
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-cash-coin text-success me-2"></i> Total Utang:</strong> Rp {{ number_format($debt->jumlah, 0, ',', '.') }}
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-wallet2 text-info me-2"></i> Total Dibayar:</strong> Rp {{ number_format($debt->total_bayar, 0, ',', '.') }}
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-graph-down-arrow text-warning me-2"></i> Sisa Utang:</strong> Rp {{ number_format($debt->sisa_utang, 0, ',', '.') }}
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-check2-circle text-dark me-2"></i> Status:</strong>
                            <span class="badge {{ $debt->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $debt->status ? 'Lunas' : 'Belum Lunas' }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- ✅ Form Tambah Utang Baru --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <i class="bi bi-plus-circle text-primary me-2"></i> Tambah Utang Baru
                </div>
                <div class="card-body">
                    <form action="{{ route('debts.addDebt', $debt->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Jumlah Utang Baru</label>
                            <input type="number" name="jumlah" class="form-control" required min="1">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Utang
                        </button>
                    </form>
                </div>
            </div>

            {{-- ✅ Form Tambah Cicilan --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <i class="bi bi-cash-coin text-success me-2"></i> Tambah Cicilan
                </div>
                <div class="card-body">
                    <form action="{{ route('payments.store', $debt->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Jumlah Bayar</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-wallet2"></i> Tambah Pembayaran
                        </button>
                    </form>
                </div>
            </div>

            {{-- ✅ Riwayat Tambah Utang --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <i class="bi bi-journal-plus text-info me-2"></i> Riwayat Tambah Utang
                </div>
                <div class="card-body">
                    <p>Total penambahan: <strong>{{ $debt->histories->count() }}</strong> kali</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($debt->histories as $index => $history)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($history->tanggal)->format('d/m/Y') }}</td>
                                    <td>Rp {{ number_format($history->jumlah, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada riwayat tambah utang</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ✅ Riwayat Cicilan --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <i class="bi bi-journal-check text-success me-2"></i> Riwayat Pembayaran
                </div>
                <div class="card-body">
                    <p>Total cicilan: <strong>{{ $debt->payments->count() }}</strong> kali</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($debt->payments as $index => $payment)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->tanggal)->format('d/m/Y') }}</td>
                                    <td>Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada riwayat cicilan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <a href="{{ route('debts.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
