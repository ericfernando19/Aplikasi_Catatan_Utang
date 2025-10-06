@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📒 Daftar Catatan Utang</h2>

    {{-- 🔍 Form Search --}}
    <form action="{{ route('debts.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2"
               placeholder="Cari nama atau keterangan..."
               value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
        @if(request('search'))
            <a href="{{ route('debts.index') }}" class="btn btn-secondary ms-2">Reset</a>
        @endif
    </form>

    <a href="{{ route('debts.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Utang
    </a>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Sisa</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($debts as $debt)
                <tr>
                    <td>{{ $debt->nama }}</td>
                    <td>Rp {{ number_format($debt->jumlah, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($debt->sisa_utang, 0, ',', '.') }}</td>
                    <td>{{ $debt->tanggal }}</td>
                    <td>
                        <span class="badge {{ $debt->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $debt->status ? 'Lunas' : 'Belum Lunas' }}
                        </span>
                    </td>
                    <td class="text-center">
                    {{-- Detail --}}
                    <a href="{{ route('debts.show',$debt->id) }}"
                    class="btn btn-sm btn-light me-1"
                    data-bs-toggle="tooltip" title="Lihat Detail">
                    <i class="bi bi-eye text-primary"></i>
                    </a>

                    {{-- Edit --}}
                    <a href="{{ route('debts.edit',$debt->id) }}"
                    class="btn btn-sm btn-light me-1"
                    data-bs-toggle="tooltip" title="Edit Data">
                    <i class="bi bi-pencil-square text-warning"></i>
                    </a>

                    {{-- Delete --}}
                    <form action="{{ route('debts.destroy',$debt->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit"
                        class="btn btn-sm btn-light"
                        onclick="return confirm('Hapus catatan ini?')"
                        data-bs-toggle="tooltip" title="Hapus Catatan">
                        <i class="bi bi-trash text-danger"></i>
                        </button>
                    </form>
                </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada data ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ✅ Script untuk Tooltip --}}
<script>
    document.addEventListener("DOMContentLoaded", function(){
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (el) {
            return new bootstrap.Tooltip(el)
        })
    });
</script>
@endsection
