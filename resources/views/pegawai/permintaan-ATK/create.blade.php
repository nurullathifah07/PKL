@extends('layout.pegawai_layout')

@section('title', 'Ajukan Permintaan ATK')

@section('content')

<h4 class="page-title mb-4">Ajukan Permintaan ATK</h4>

<div class="card shadow border-0">

    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Form Permintaan Barang</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('permintaan-ATK.store') }}" method="POST">
            @csrf

            {{-- Keterangan --}}
            <div class="mb-3">
                <label>Keterangan (opsional)</label>
                <input type="text" name="keterangan" class="form-control">
            </div>

            <hr>

            <h5 class="mb-3">Daftar Barang Diminta</h5>

            {{-- TABEL BARANG --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-barang">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>Barang</th>
                            <th width="140">Jumlah</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- ROW PERTAMA --}}
                        <tr class="row-barang">
                            <td>
                                <select name="barang[0][id_barang]"
                                        class="form-control"
                                        required>
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach($barang as $b)
                                        <option value="{{ $b->id_barang }}">
                                            {{ $b->nama_barang }} (stok: {{ $b->stok }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="number"
                                       name="barang[0][jumlah_keluar]"
                                       class="form-control"
                                       min="1"
                                       required>
                            </td>

                            <td class="text-center">
                                <button type="button"
                                        class="btn btn-danger btn-sm btn-remove"
                                        disabled>
                                    <i class="la la-trash"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            {{-- BUTTON TAMBAH --}}
            <button type="button"
                    class="btn btn-secondary btn-sm mb-3"
                    id="tambah-barang">
                + Tambah Barang
            </button>

            <hr>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    Kirim Permintaan
                </button>
            </div>

        </form>

    </div>
</div>


{{-- ================= SCRIPT DINAMIS ================= --}}
<script>
let index = 1;

document.getElementById('tambah-barang').addEventListener('click', function () {

    let tbody = document.querySelector('#tabel-barang tbody');

    let row = document.querySelector('.row-barang').cloneNode(true);

    row.querySelectorAll('select, input').forEach(el => {
        el.name = el.name.replace(/\[\d+\]/, `[${index}]`);
        el.value = '';
    });

    row.querySelector('.btn-remove').disabled = false;

    tbody.appendChild(row);

    index++;
});

document.addEventListener('click', function (e) {
    if (e.target.closest('.btn-remove')) {
        e.target.closest('tr').remove();
    }
});
</script>

@endsection
