@extends('layout.operator_layout')

@section('title', 'Daftar Barang Keluar')

@section('content')

<h4 class="page-title">Daftar Barang Keluar</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title">Daftar Barang Keluar</h4>

                <a href="{{ route('operator.barang_keluar.create') }}"
                   class="btn btn-primary btn-round ml-auto">
                    <i class="la la-plus"></i> Tambah Barang Keluar
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pemohon</th>
                                <th>Keterangan</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($barangKeluar as $bk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($bk->tanggal_keluar)->format('d M Y') }}
                                    </td>

                                    <td>
                                        {{ $bk->pegawai->nama_pegawai ?? '-' }}
                                    </td>

                                    <td>{{ $bk->keterangan ?? '-' }}</td>

                                    <td>
                                        <div class="form-button-action">

                                            {{-- SHOW --}}
                                            <a href="{{ route('operator.barang_keluar.show', $bk->id_barang_keluar) }}"
                                               class="btn btn-link btn-info btn-sm"
                                               title="Detail">
                                                <i class="la la-eye"></i>
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('operator.barang_keluar.edit', $bk->id_barang_keluar) }}"
                                               class="btn btn-link btn-primary btn-sm"
                                               title="Edit">
                                                <i class="la la-edit"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('operator.barang_keluar.destroy', $bk->id_barang_keluar) }}"
                                                  method="POST"
                                                  style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-link btn-danger btn-sm"
                                                        title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="la la-times"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Data belum tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
