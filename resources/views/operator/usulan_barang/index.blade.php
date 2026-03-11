@extends('layout.admin_layout')

@section('title','Usulan Barang')

@section('content')
<div class="container-fluid">

    <h4 class="page-title mb-4 text-gray-800">Daftar Usulan Barang</h4>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Pegawai</th>
                        <th>Nama Barang</th>
                        <th width="90">Jumlah</th>
                        <th>Keterangan</th>
                        <th width="130">Status</th>
                        <th width="180">Aksi</th>
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
                                <span class="badge badge-warning">Menunggu</span>

                            @elseif($u->status == 'disetujui')
                                <span class="badge badge-success">Disetujui</span>

                            @elseif($u->status == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                                <br>
                                <small class="text-muted">{{ $u->alasan_penolakan }}</small>
                            @endif
                        </td>

                        <td>
                            @if($u->status == 'pending')

                                <button
                                    onclick="setujuiUsulan({{ $u->id }}, '{{ $u->nama_barang_usulan }}')"
                                    class="btn btn-success btn-sm">
                                    Setujui
                                </button>

                                <button
                                    onclick="tolakUsulan({{ $u->id }})"
                                    class="btn btn-danger btn-sm">
                                    Tolak
                                </button>

                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data usulan barang
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection


@section('scripts')
<script>

function setujuiUsulan(id, namaBarang){

    Swal.fire({
        title: 'Tambah Barang',

        html: `
            <input id="nama_barang" class="swal2-input" value="${namaBarang}" placeholder="Nama Barang">
            <input id="kode_barang" class="swal2-input" placeholder="Kode Barang">
            <input id="satuan" class="swal2-input" placeholder="Satuan">
        `,

        confirmButtonText: 'Simpan',
        showCancelButton: true,

        preConfirm: () => {
            return {
                nama_barang: document.getElementById('nama_barang').value,
                kode_barang: document.getElementById('kode_barang').value,
                satuan: document.getElementById('satuan').value
            }
        }

    }).then((result)=>{

        if(result.isConfirmed){

            let form = document.createElement("form")
            form.method = "POST"
            form.action = "{{ url('admin/usulan_barang') }}/" + id + "/setujui"

            let csrf = document.createElement("input")
            csrf.type = "hidden"
            csrf.name = "_token"
            csrf.value = "{{ csrf_token() }}"

            let nama = document.createElement("input")
            nama.type = "hidden"
            nama.name = "nama_barang"
            nama.value = result.value.nama_barang

            let kode = document.createElement("input")
            kode.type = "hidden"
            kode.name = "kode_barang"
            kode.value = result.value.kode_barang

            let satuan = document.createElement("input")
            satuan.type = "hidden"
            satuan.name = "satuan"
            satuan.value = result.value.satuan

            form.appendChild(csrf)
            form.appendChild(nama)
            form.appendChild(kode)
            form.appendChild(satuan)

            document.body.appendChild(form)
            form.submit()
        }

    })
}



function tolakUsulan(id){

    Swal.fire({
        title: 'Tolak Usulan',
        input: 'textarea',
        inputLabel: 'Alasan Penolakan',
        inputPlaceholder: 'Masukkan alasan penolakan...',
        showCancelButton: true,
        confirmButtonText: 'Tolak',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',

        inputValidator: (value)=>{
            if(!value){
                return 'Alasan harus diisi!'
            }
        }

    }).then((result)=>{

        if(result.isConfirmed){

            let form = document.createElement("form")
            form.method = "POST"
            form.action = "{{ url('admin/usulan_barang') }}/" + id + "/tolak"

            let csrf = document.createElement("input")
            csrf.type = "hidden"
            csrf.name = "_token"
            csrf.value = "{{ csrf_token() }}"

            let alasan = document.createElement("input")
            alasan.type = "hidden"
            alasan.name = "alasan_penolakan"
            alasan.value = result.value

            form.appendChild(csrf)
            form.appendChild(alasan)

            document.body.appendChild(form)
            form.submit()
        }

    })
}

</script>
@endsection
