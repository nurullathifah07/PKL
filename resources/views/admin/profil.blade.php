@extends('layout.admin_layout')

@section('title', 'Profil Admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Akun</h6>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <img src="{{ asset('assets/img/profile.jpg') }}"
                            alt="user" class="img-fluid rounded-circle profile-img">

                        <h5 class="mt-3">Hizrian Fulan</h5>
                        <p class="text-muted">Administrator</p>

                        <a href="{{ url('admin/profil_edit') }}" class="btn btn-warning btn-sm mt-2">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a>
                    </div>

                    <div class="col-md-8">
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">Username</th>
                                    <td>hizrian</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>Hizrian Fulan</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>hizrian@example.com</td>
                                </tr>
                                <tr>
                                    <th>Level Akses</th>
                                    <td><span class="badge badge-primary">Administrator</span></td>
                                </tr>
                                <tr>
                                    <th>Terdaftar Sejak</th>
                                    <td>1 Januari 2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
