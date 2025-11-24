@extends('layout.admin_layout')

@section('title', 'Akun')

@section('content')
    <div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daftar Akun</h5>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="#" class="btn btn-primary">Tambah Akun</a>

                <!-- Default Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Level</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                <!-- End Default Table Example -->
            </div>
        </div>
    </div>
@endsection
