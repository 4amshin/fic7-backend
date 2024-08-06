@extends('layout.app')

@section('page-title', 'Beranda')

@section('content')
    <div class="row">
        <!--Card Welcome-->
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">

                    <!--Card Welcome-->
                    <div class="col-sm-7">
                        <div class="card-body">

                            <h5 class="card-title text-primary">Selamat Datang {{ auth()->user()->role }} {{ auth()->user()->name }}! 🎉</h5>
                            <p class="mb-4">
                                Lengkapi Profil anda untuk melakukan penyewaan, klik tombol 'Lihat Profil' dibawah ini untuk
                                melengkapi profil.
                            </p>

                            <a href="{{ route('user.profile') }}" class="btn btn-sm btn-outline-primary">Lihat Profil</a>
                        </div>
                    </div>

                    <!--Vector Image-->
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
