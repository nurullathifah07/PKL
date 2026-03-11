@extends('layout.admin_layout')

@section('content')

<div class="container-fluid">

<h4 class="page-title mb-4 text-gray-800">Data Usulan Barang</h4>

<div class="card shadow">
    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th width="50">No</th>
                    <th>Nama Pegawai</th>
                    <th>Nama Barang</th>
                    <th width="100">Jumlah</th>
                    <th>Keterangan</th>
                    <th width="150">Status</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($usulan as $u)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $u->pegawai->nama_pegawai ?? '-' }}</td>

                    <td>{{ $u->nama_barang_usulan }}</td>

                    <td>{{ $u->jumlah_usulan }}</td>

                    <td>{{ $u->keterangan }}</td>

                    <td>
                        @if($u->status == 'pending')

                            <span class="badge badge-warning">
                                Menunggu
                            </span>

                        @elseif($u->status == 'disetujui')

                            <span class="badge badge-success">
                                Disetujui
                            </span>

                        @elseif($u->status == 'ditolak')

                            <span class="badge badge-danger">
                                Ditolak
                            </span>

                            <br>

                            <small class="text-danger">
                                Alasan: {{ $u->alasan_penolakan }}
                            </small>

                        @endif
                    </td>

                    <td>

                        {{-- AKSI SAAT STATUS PENDING --}}
                        @if($u->status == 'pending')

                            <div class="dropdown">

                                <button
                                    class="btn btn-primary btn-sm dropdown-toggle"
                                    type="button"
                                    data-toggle="dropdown">
                                    Aksi
                                </button>

                                <div class="dropdown-menu">

                                    {{-- SETUJUI --}}
                                    <a href="{{ route('admin.usulan_barang.setujui', $u->id_usulan_barang) }}"
                                       class="dropdown-item"
                                       onclick="return confirm('Yakin menyetujui usulan ini?')">
                                        Setujui
                                    </a>

                                    {{-- TOLAK --}}
                                    <button
                                        class="dropdown-item text-danger"
                                        data-toggle="modal"
                                        data-target="#tolakModal{{ $u->id_usulan_barang }}">
                                        Tolak
                                    </button>

                                </div>

                            </div>

                        @endif


                        {{-- HAPUS --}}
                        @if($u->status == 'disetujui' || $u->status == 'ditolak')

                            <form
                                action="{{ route('admin.usulan_barang.destroy', $u->id_usulan_barang) }}"
                                method="POST"
                                style="display:inline"
                                onsubmit="return confirm('Yakin ingin menghapus usulan ini?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Hapus
                                </button>

                            </form>

                        @endif

                    </td>
                </tr>


                {{-- MODAL TOLAK --}}
                <div class="modal fade" id="tolakModal{{ $u->id_usulan_barang }}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form action="{{ route('admin.usulan_barang.tolak', $u->id_usulan_barang) }}" method="POST">
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title">Alasan Penolakan</h5>

                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <textarea
                                        name="alasan_penolakan"
                                        class="form-control"
                                        placeholder="Masukkan alasan penolakan..."
                                        required></textarea>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Batal
                                    </button>

                                    <button type="submit" class="btn btn-danger">
                                        Tolak Usulan
                                    </button>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            @empty

                <tr>
                    <td colspan="7" class="text-center">
                        Belum ada usulan barang
                    </td>
                </tr>

            @endforelse

            </tbody>
        </table>

    </div>
</div>

</div>

@endsection
