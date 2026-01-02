@extends('layout.admin_layout')

@section('title', 'Daftar Barang Keluar')

@section('content')

<h4 class="page-title">Daftar Barang Keluar</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title">Daftar Barang Keluar</h4>

                <a href="{{ route('barang_keluar.create') }}"
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
                                    <td>{{ $bk->nama_pemohon }}</td>
                                    <td>{{ $bk->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('barang_keluar.show', $bk->id_barang_keluar) }}"
                                           class="btn btn-info btn-sm"
                                           title="Lihat Surat">
                                            <i class="la la-eye"></i>
                                        </a>

                                        <form action="{{ route('barang_keluar.destroy', $bk->id_barang_keluar) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="la la-trash"></i>
                                            </button>
                                        </form>
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
