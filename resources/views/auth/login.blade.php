@extends('layout.auth_layout')

@section('title', 'Login')

@section('content')

<div class="col-xl-5 col-lg-6 col-md-9 col-xl-5-custom">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">

                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/img/logo BPS.png') }}"
                                alt="Logo BPS"
                                class="mb-3"
                                style="width: 90px;">
                            <h5 class="h4 text-gray-900 mb-1">BPS Kabupaten Banjar</h5>
                            <h6 class="h4 text-gray-900">Permintaan ATK/ARK</h6>
                        </div>

                        {{-- Form Login --}}
                        <form class="user" method="POST" action="{{ url('/login') }}">
                            @csrf

                            {{-- Pesan error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger small">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            {{-- Username / Email --}}
                            <div class="form-group">
                                <input type="text"
                                    name="login"
                                    class="form-control form-control-user"
                                    placeholder="Username atau Email"
                                    value="{{ old('login') }}"
                                    required>
                            </div>

                            {{-- Password --}}
                            <div class="form-group">
                                <input type="password"
                                    name="password"
                                    class="form-control form-control-user"
                                    placeholder="Password"
                                    required>
                            </div>

                            {{-- Remember Me (opsional) --}}
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox"
                                        class="custom-control-input"
                                        id="remember">
                                    <label class="custom-control-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            {{-- Tombol Login --}}
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                        </form>

                        <hr>

                        {{-- Opsional (boleh dihapus kalau tidak dipakai) --}}
                        {{--
                        <div class="text-center">
                            <a class="small" href="#">Forgot Password?</a>
                        </div>
                        --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
