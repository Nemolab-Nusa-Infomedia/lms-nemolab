@extends('components.layouts.member.app')

@section('title', 'Transactions')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
    <style>
        @media only screen and (max-width: 992px) {
            .profile-btn.btn {
                background-color: #faa907;
            }

            .profile-btn.btn:active {
                background-color: #d89309;
            }

            .sidebar-mobile {
                display: none !important;
            }

            .sidebar-mobile.active {
                display: block !important;
                z-index: 999;
                position: absolute;
                width: 100%;
                bottom: 0;
                left: 0;
                max-height: 60vh;
                border-radius: 50px 50px 0 0;
                background: #fff;
            }

            .nav a {
                color: #6c757d !important;
            }

            .nav-item img {
                filter: grayscale(100%) brightness(70%);
            }

            .nav-item.active,
            .nav-item.active img {
                filter: none;
                color: #faa907 !important;
                font-weight: 600;
                padding: 0;
                gap: 0;
            }

        }
    </style>
@endpush

@section('content')
    <section id="transaction">
        <div class="container" style="margin-top: 5rem;">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-3 d-none d-lg-block p-4 pb-5 rounded-4 text-white px-5 flex-wrap"
                    style="background-color: #faa907; ">
                    @if (Auth::user()->avatar != 'default.png')
                        <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                            style="border-radius: 100%;" alt="" width="70" height="70"
                            class="d-flex mx-lg-auto mt-3" />
                    @else
                        <img src="{{ asset('nemolab/admin/img/avatar.png') }}" style="border-radius: 100%;" alt=""
                            width="70" height="70" class="d-flex mx-lg-auto mt-3" />
                    @endif
                    <h4 class="m-0 mt-lg-5 mt-3 fw-semibold">{{ Auth::user()->name }}</h4>
                    <p class="m-0 fw-light">Status {{ Auth::user()->role }}</p>
                    <div class="mt-5">
                        <a href="{{ route('member.dashboard') }}" class="list-sidebar">
                            <img src="{{ asset('nemolab/member/img/course.png') }}" alt="" width="30" />
                            <p class="m-0">Kursus Saya</p>
                        </a>
                        <a href="{{ route('member.portofolio') }}" class="list-sidebar">
                            <img src="{{ asset('nemolab/member/img/portofolio.png') }}" alt="" width="30" />
                            <p class="m-0">Portofolio Saya</p>
                        </a>
                        <a href="{{ route('member.transaction') }}" class="list-sidebar active">
                            <img src="{{ asset('nemolab/member/img/transaksi active.png') }}" alt=""
                                width="30" />
                            <p class="m-0">Transaksi Saya</p>
                        </a>
                    </div>
                </div>
                <!-- End Sidebar -->

                <!-- Tabel -->
                <div class="col-lg-9 col-md-12 col-12 ps-lg-5 ps-3">
                    <div class="d-block d-lg-none">
                        <div id="profile" class="fw-medium">
                            <button class="profile-btn btn fw-medium text-white">Profil Saya</button>
                        </div>
                        <div class="sidebar-mobile p-5 d-none border border-2">
                            <div class="d-flex gap-3 align-items-center">
                                <div>
                                    @if (Auth::user()->avatar != 'default.png')
                                        <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}"
                                            alt="" width="60" height="60" class="rounded-circle" />
                                    @else
                                        <img src="{{ asset('nemolab/member/img/avatar.png') }}" alt=""
                                            width="60" height="60" />
                                    @endif
                                </div>
                                <div class="text-dark">
                                    <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                    <p class="m-0 fw-light">Status {{ Auth::user()->role }}</p>
                                </div>
                            </div>
                            <div class="nav mt-4 d-flex flex-column gap-3 fw-medium text-secondary">
                                <a href="{{ route('member.dashboard') }}" class="nav-item">
                                    <img src="{{ asset('nemolab/member/img/course active.png') }}" alt=""
                                        width="30" class="me-2" />Kursus Saya
                                </a>
                                <a href="{{ route('member.portofolio') }}" class="nav-item">
                                    <img src="{{ asset('nemolab/member/img/portofolio active.png') }}" alt=""
                                        width="30" class="me-2" />Profil Saya
                                </a>
                                <a href="#" class="nav-item active">
                                    <img src="{{ asset('nemolab/member/img/transaksi active.png') }}" alt=""
                                        width="30" class="me-2" />Transaksi Saya
                                </a>
                            </div>
                            <div class="mt-4">
                                <button id="tutup" class="profile-btn btn rounded-5 w-100 fw-medium text-white"
                                    type="button">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <h3 class="fw-semibold" style="color: #faa907">Transaksi Saya</h3>
                    </div>

                    <div class="table-responsive p-3 border border-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center ms-3 mt-2">
                                <p class="mb-0 me-2 text-center">Menampilkan</p>
                                <form method="GET" action="{{ route('member.transaction') }}" id="entries-form">
                                    <select id="entries" name="per_page" class="form-select form-select-sm"
                                        onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10
                                        </option>
                                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25
                                        </option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                        </option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </form>
                                <p class="mb-0 me-2 text-center mx-2">entri</p>
                            </div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sampul</th>
                                    <th>Nama Produk</th>
                                    <th>Tipe</th>
                                    <th>Harga</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>
                                            @if ($transaction->course)
                                                <img src="{{ asset('storage/images/covers/' . $transaction->course->cover) }}"
                                                    alt="Cover" width="90" height="auto" />
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td class="text-capitalize">{{ $transaction->name }}</td>
                                        <td class="text-capitalize">
                                            {{ $transaction->course ? $transaction->course->type : '-' }}
                                        </td>
                                        <td class="text-capitalize">Rp
                                            {{ number_format($transaction->price, 2, ',', '.') }}
                                        </td>
                                        <td class="text-capitalize">{{ $transaction->created_at->format('d-M-Y') }}</td>
                                        @if ($transaction->status === 'success')
                                            <td class="text-capitalize text-success">{{ ucfirst($transaction->status) }}
                                            </td>
                                        @elseif($transaction->status === 'failed')
                                            <td class="text-capitalize text-danger">{{ ucfirst($transaction->status) }}
                                            </td>
                                        @else
                                            <td class="text-capitalize text-warning">{{ ucfirst($transaction->status) }}
                                            </td>
                                        @endif
                                        <td>
                                            @if ($transaction->status === 'pending')
                                                <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                    class="d-flex gap-2" method="POST"
                                                    onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <a href="" class="btn btn-success btn-sm">Bayar Kelas</a> --}}
                                                    <button type="submit" class="btn btn-danger btn-sm">Batalkan
                                                        Pembelian</button>
                                                    <a href="{{ route('member.transaction.view', $transaction->id) }}"
                                                        class="btn btn-primary">
                                                        Bayar
                                                    </a>
                                                </form>
                                            @elseif ($transaction->status === 'failed')
                                                <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus
                                                        Transaksi</button>
                                                </form>
                                            @else
                                                <div>
                                                    -
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between p-1">
                            <p class="show">Menampilkan {{ $transactions->firstItem() }} hingga
                                {{ $transactions->lastItem() }}
                                dari
                                {{ $transactions->total() }}</p>
                            <div class="d-flex gap-3">
                                <!-- Custom Pagination -->
                                <button class="pagination mx-1 {{ $transactions->onFirstPage() ? 'disabled' : '' }}"
                                    id="prev-button" {{ $transactions->onFirstPage() ? 'disabled' : '' }}
                                    data-url="{{ $transactions->previousPageUrl() }}">Previous</button>
                                <button class="pagination mx-1 {{ $transactions->hasMorePages() ? '' : 'disabled' }}"
                                    id="next-button" {{ $transactions->hasMorePages() ? '' : 'disabled' }}
                                    data-url="{{ $transactions->nextPageUrl() }}">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('prev-button').addEventListener('click', function() {
            if (!this.classList.contains('disabled')) {
                window.location.href = this.getAttribute('data-url');
            }
        });

        document.getElementById('next-button').addEventListener('click', function() {
            if (!this.classList.contains('disabled')) {
                window.location.href = this.getAttribute('data-url');
            }
        });

        document.getElementById("profile").addEventListener("click", function() {
            document.querySelector(".sidebar-mobile").classList.add("active");
        })
        document.getElementById("tutup").addEventListener("click", function() {
            document.querySelector(".sidebar-mobile").classList.remove("active");
        })
    </script>
@endsection
