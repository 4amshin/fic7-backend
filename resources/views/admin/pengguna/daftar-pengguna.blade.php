@extends('layout.app')

@section('page-title', 'Daftar Pengguna')

@section('content')
    <!-- Alert -->
    @include('layout.page-alert')

    <!-- Tabel -->
    <div class="card">
        <div class="float-left p-3">
            <a href="{{ route('user.create') }}" class="btn btn-primary"> Tambah Pengguna</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        {{-- <th>No</th> --}}
                        <th class="text-center">Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        @can('super-user')
                            <th>Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($daftarPengguna as $index => $user)
                        <tr>
                            {{-- <td>
                                {{ $index + $daftarPengguna->firstItem() }}
                            </td> --}}
                            <td class="text-center d-flex justify-content-center">
                                <div class="avatar">
                                    <img src="{{ $user->profile_img ? asset('storage/profile/' . $user->profile_img) : asset('assets/img/avatars/1.png') }}"
                                        alt class="w-px-40 rounded-circle fill-box w-p" />
                                </div>
                            </td>
                            <td>
                                <strong>
                                    {{ $user->name }}
                                </strong>
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                <span class="badge bg-label-info me-1">
                                    {{ $user->phone }}
                                </span>
                            </td>
                            @can('super-user')
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!--Tombol Update-->
                                            <a href="{{ route('user.edit', $user->id) }}" class="dropdown-item">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>

                                            <!--Tombol Hapus-->
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bx bx-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td>Data Tidak Ditemukan</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!--Navigasi Halaman-->
        <nav class="p-3" aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                {{ $daftarPengguna->withQueryString()->links() }}
            </ul>
        </nav>

    </div>
    <!--/ Basic Bootstrap Table -->

@endsection
