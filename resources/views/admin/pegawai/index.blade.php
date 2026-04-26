@extends('layout.admin_layout')

@section('title', 'Daftar Pegawai')

@section('content')

<h4 class="page-title">Daftar Pegawai</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Pegawai</h4>

                    <a href="{{ route('admin.pegawai.create') }}"
                       class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Pegawai
                    </a>
                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body">
                <div class="table-responsive">

                    <table id="tabel-pegawai" class="display table table-bordered table-hover">

                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>NIP BPS</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan</th>
                                <th>Subbagian/Seksi</th>
                                <th>Username</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">

                            @forelse ($pegawai as $p)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                {{-- FOTO --}}
                                <td>
                                    @if ($p->foto)
                                        <img src="{{ asset('storage/' . $p->foto) }}"
                                             width="45"
                                             height="45"
                                             style="border-radius:50%; object-fit:cover;">
                                    @else
                                        <i class="la la-user-circle text-secondary"
                                           style="font-size:32px;"></i>
                                    @endif
                                </td>

                                <td>{{ $p->nip_bps }}</td>
                                <td>{{ $p->nip }}</td>
                                <td>{{ $p->nama_pegawai }}</td>
                                <td>{{ $p->jabatan }}</td>
                                <td>{{ $p->subbagian ?? '-' }}</td>
                                <td>{{ $p->akun->username ?? '-' }}</td>

                                {{-- AKSI --}}
                                <td>
                                    <div class="form-button-action">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.pegawai.show',$p->id_pegawai) }}"
                                           class="btn btn-link btn-info btn-sm"
                                           title="Detail">
                                            <i class="la la-eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.pegawai.edit',$p->id_pegawai) }}"
                                           class="btn btn-link btn-primary btn-sm"
                                           title="Edit">
                                            <i class="la la-edit"></i>
                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.pegawai.destroy',$p->id_pegawai) }}"
                                            method="POST"
                                            class="form-hapus"
                                            data-judul="pegawai"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-link btn-danger btn-sm"
                                                    title="Hapus">
                                                <i class="la la-times"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="9" class="text-center text-muted">
                                    Data pegawai belum tersedia
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

@section('scripts')

<script>
$(document).ready(function(){

    $('#tabel-pegawai').DataTable({
        pageLength: 10,
        searching: false,
        lengthChange: false,
        language:{
            paginate:{
                previous:"Sebelumnya",
                next:"Berikutnya"
            },
            info:"Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty:"Data tidak tersedia",
            zeroRecords:"Data tidak ditemukan"
        }
    });

});
</script>

@endsection
