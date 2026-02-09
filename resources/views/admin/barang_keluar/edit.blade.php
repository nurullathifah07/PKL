@extends('layout.admin_layout')

@section('title', 'Edit Barang Keluar')

@section('content')

<div class="card shadow">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Edit Barang Keluar</h5>
    </div>

    <div class="card-body">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.barang_keluar.update', $barangKeluar->id_barang_keluar) }}"
              method="POST">
            @csrf
            @method('PUT')

            {{-- INFO BON --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Tanggal Keluar</label>
                    <input type="date" class="form-control"
                           value="{{ $barangKeluar->tanggal_keluar }}" disabled>
                </div>

                <div class="col-md-4">
                    <label>Pemohon</label>
                    <input type="text" class="form-control"
                           value="{{ $barangKeluar->pegawai->nama_pegawai }}" disabled>
                </div>

                <div class="col-md-4">
                    <label>Keterangan</label>
                    <input type="text" class="form-control"
                           value="{{ $barangKeluar->keterangan }}" disabled>
                </div>
            </div>

            <hr>

            {{-- DETAIL BARANG --}}
            <h6>Daftar Barang</h6>

            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>Nama Barang</th>
                        <th width="150">Jumlah Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangKeluar->details as $i => $d)
                    <tr>
                        <td>
                            {{ $d->barang->nama_barang }}
                            <input type="hidden"
                                   name="barang[{{ $i }}][id_detail_bk]"
                                   value="{{ $d->id_detail_bk }}">
                            <input type="hidden"
                                   name="barang[{{ $i }}][id_barang]"
                                   value="{{ $d->id_barang }}">
                        </td>
                        <td>
                            <input type="number"
                                   name="barang[{{ $i }}][jumlah_keluar]"
                                   class="form-control"
                                   min="1"
                                   value="{{ $d->jumlah_keluar }}"
                                   required>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center">
                <button class="btn btn-primary">
                    Update
                </button>
                <a href="{{ route('admin.barang_keluar.show', $barangKeluar->id_barang_keluar) }}"
                   class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
