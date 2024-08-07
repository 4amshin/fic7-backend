@extends('layout.app')

@section('page-title', 'Tambah Pengguna')

@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <!--Nama & Nomor Telepon-->
                        <div class="row">
                            <!--Nama-->
                            <div class="col-6 mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" autofocus required>
                            </div>

                            <!--Nomor Telepon-->
                            <div class="col-6 mb-3">
                                <label class="form-label" for="phone">Nomor Telepon</label>
                                <input type="text" id="phone" name="phone"
                                    class="form-control phone-mask">
                            </div>
                        </div>

                        <!--Email & Password-->
                        <div class="row">
                            <!--Email-->
                            <div class="col-6 mb-3">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Masukkan Email Anda" autofocus />

                                <!--Pesan Eror-->
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!--Password-->
                            <div class="col-6 mb-3 form-password-toggle">
                                <!--Label & Link Lupa Password-->
                                <div class="d-flex justify-content-between">
                                    <!--Label-->
                                    <label class="form-label" for="unhashed_password">Password</label>
                                </div>

                                <div class="input-group input-group-merge">
                                    <input type="password" id="unhashed_password"
                                        class="form-control" name="unhashed_password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="unhashed_password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div>

                        <!---Bio-->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="bio">Bio</label>
                                <input type="text" id="bio" name="bio"
                                    class="form-control">
                            </div>
                        </div>

                        <!--Tombol Submit-->
                        <div class="row p-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
