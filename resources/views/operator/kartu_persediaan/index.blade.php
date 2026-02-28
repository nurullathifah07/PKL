@extends('layout.operator_layout')

@section('content')

<h4 class="page-title">Kartu Persediaan</h4>

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white border-0 pt-3">
            <h6 class="mb-0 fw-bold">Kartu Persediaan</h6>
        </div>

        <div class="card-body pt-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang as $key => $b)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="fw-semibold">{{ $b->nama_barang }}</td>
                            <td>{{ $b->satuan }}</td>
                            <td class="text-center">
                                <a href="{{ route('operator.kartu_persediaan.show', $b->id_barang) }}"
                                   class="btn btn-sm btn-primary px-3">
                                    Lihat Kartu
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Tidak ada data barang
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection
