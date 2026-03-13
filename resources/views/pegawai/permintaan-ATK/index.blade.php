@extends('layout.pegawai_layout')

@section('title','Riwayat Permintaan ATK')

@section('content')

<div class="container-fluid">

```
<h4 class="page-title mb-4 text-gray-800">Riwayat Permintaan ATK</h4>

<div class="card shadow">
    <div class="card-body">

        <div class="table-responsive">

            <table id="tabel-riwayat" class="display table table-bordered table-hover">

                <thead class="text-center">
                    <tr>
                        <th width="60">No</th>
                        <th>Tanggal</th>
                        <th>Jumlah Item</th>
                        <th>Keterangan</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-center">

                    @forelse($riwayat as $row)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($row->tanggal_keluar)->format('d-m-Y') }}
                        </td>

                        <td>
                            <span class="badge badge-primary">
                                {{ $row->details->count() }} barang
                            </span>
                        </td>

                        <td>{{ $row->keterangan ?? '-' }}</td>

                        <td>
                            <a href="{{ route('permintaan-ATK.show',$row) }}"
                               class="btn btn-sm btn-info">
                                <i class="bi bi-printer"></i> Detail / Print
                            </a>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Belum ada permintaan ATK
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>
```

</div>

@endsection

@section('scripts')

<script>
$(document).ready(function(){

    $('#tabel-riwayat').DataTable({
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
