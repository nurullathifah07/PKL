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

                    <a href="{{ route('pegawai.create') }}"
                       class="btn btn-primary btn-round ml-auto">
                        <i class="la la-plus"></i> Tambah Pegawai
                    </a>
                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-hover">
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
                                <th style="width: 12%">Aksi</th>
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
                                                 alt="Foto Pegawai"
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
                                    <td>{{ $p->subbagian?? '-' }}</td>
                                    <td>{{ $p->akun->username ?? '-' }}</td>

                                    {{-- AKSI --}}
                                    <td>
                                        <div class="form-button-action">

                                            {{-- SHOW --}}
                                            <a href="{{ route('pegawai.show', $p->id_pegawai) }}"
                                               class="btn btn-link btn-info btn-sm"
                                               title="Detail">
                                                <i class="la la-eye"></i>
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('pegawai.edit', $p->id_pegawai) }}"
                                               class="btn btn-link btn-primary btn-sm"
                                               title="Edit">
                                                <i class="la la-edit"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('pegawai.destroy', $p->id_pegawai) }}"
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
                                    <td colspan="14" class="text-center text-muted">
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
    // kalau pakai datatable, init di sini
</script>
@endsection
