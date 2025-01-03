@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Lihat informasi dan perkembangan anda disini')
@section('hide_footer')
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard-css/transaction.css') }} ">
@endpush
@section('content')
    <section class="section-pilih-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">
                @include('components.includes.member.sidebar-dashboard')
                <div class="card-container col-xl-9 col-lg-8 pe-4">
                    <div class="mb-4">
                        <h3 class="fw-bold">Transaksi Saya</h3>
                    </div>
                    <!-- Navigation Tabs -->
                    <div class="filter-transaction">
                        <ul class="nav-tabs">
                            <li><a href="{{ route('member.transaction', ['status' => null]) }}"
                                    class="{{ is_null($status) ? 'active' : '' }}">Semua</a></li>
                            <li><a href="{{ route('member.transaction', ['status' => 'success']) }}"
                                    class="{{ $status === 'success' ? 'active' : '' }}">Berhasil</a></li>
                            <li><a href="{{ route('member.transaction', ['status' => 'pending']) }}"
                                    class="{{ $status === 'pending' ? 'active' : '' }}">Pending</a></li>
                            {{-- <li><a href="{{ route('member.transaction', ['status' => 'refund']) }}" class="{{ $status === 'refund' ? 'active' : '' }}">Refund</a></li> --}}
                            <li><a href="{{ route('member.transaction', ['status' => 'failed']) }}"
                                    class="{{ $status === 'failed' ? 'active' : '' }}">Gagal</a></li>
                        </ul>
                    </div>
                    @if ($transactions->isEmpty())
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <div class="not-found text-center">
                                <p class="mt-3">Tidak Ada Transaksi</p>
                            </div>
                        </div>
                    @endif
                    <!-- Transaction Cards -->
                    <div class=" mt-4 courses-scroll">
                    </div>
                    {{-- @foreach ($transactions as $transaction)
                    <div class="card mt-3">
                        <div class="card-body d-flex align-items-center">
                            @php
                                $coverPath = '';
                                if ($transaction->course) {
                                    $coverPath = asset('storage/images/covers/' . $transaction->course->cover);
                                } elseif ($transaction->ebook) {
                                    $coverPath = asset('storage/images/covers/' . $transaction->ebook->cover);
                                } elseif ($transaction->bundle && $transaction->bundle->course) {
                                    $coverPath = asset('storage/images/covers/' . $transaction->bundle->course->cover);
                                }
                            @endphp
                            <img alt="Product image" src="{{ $coverPath }}" height="80" width="120" class="cover me-3" style="object-fit: cover;" />                          
                            <div class="details">
                                <p class="title fw-bold" >{{ $transaction->name }}</p>
                                    @if ($transaction->price == 0)
                                        <p class="Premium">
                                            @if ($transaction->bundle && $transaction->bundle->course)
                                                Paket
                                            @elseif($transaction->ebook)
                                                E-Book
                                            @else
                                                Kelas
                                            @endif
                                            Gratis
                                        </p>
                                    @else
                                        <p class="Premium">
                                            @if ($transaction->bundle && $transaction->bundle->course)
                                                Paket
                                            @elseif($transaction->ebook)
                                                E-Book
                                            @else
                                                Kelas
                                            @endif
                                            Premium
                                        </p>
                                    @endif
                                    <div class="info mt-2 row">
                                        <div class="col-auto">
                                            <p class="price fw-bold">Harga: Rp. {{ number_format($transaction->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <p class="date fw-bold">Tanggal: {{ $transaction->created_at->format('d-M-Y') }}</p>
                                        </div>
                                        <div class="col-auto">
                                            <p class="status fw-bold">
                                                Status: 
                                                <span class="status-info"
                                                      style="color: {{ $transaction->status === 'success' ? 'green' : ($transaction->status === 'pending' ? 'orange' : 'red') }};">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>                                                                                                                                             
                                    <div class="aksi d-flex mt-1 justify-content-end d-md-none">
                                        @if ($transaction->status === 'pending')
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Batalkan
                                                        Pembelian</button>
                                                </form>
                                                <form action="{{ route('member.transaction.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{ $transaction->course_id }}">
                                                    <input type="hidden" name="ebook_id" value="{{ $transaction->ebook_id }}">
                                                    <input type="hidden" name="bundle_id" value="{{ $transaction->bundle_id }}">
                                                    <input type="hidden" name="price" value="{{ $transaction->price }}">
                                                    <input type="hidden" name="termsCheck" value="1">
                                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                                </form>
                                            </div>
                                        @elseif ($transaction->status === 'failed')
                                            <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus
                                                    Transaksi</button>
                                            </form>
                                        @else
                                            <a href="{{ route('member.transaction.view-transaction', $transaction->transaction_code) }}"
                                                class="btn btn-primary">Cek Transaksi</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="action d-none d-md-block">
                                    @if ($transaction->status === 'pending')
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Batalkan Pembelian</button>
                                            </form>
                                            <form action="{{ route('member.transaction.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $transaction->course_id }}">
                                                <input type="hidden" name="ebook_id" value="{{ $transaction->ebook_id }}">
                                                <input type="hidden" name="bundle_id" value="{{ $transaction->bundle_id }}">
                                                <input type="hidden" name="price" value="{{ $transaction->price }}">
                                                <input type="hidden" name="termsCheck" value="1">
                                                <button type="submit" class="btn btn-primary">Bayar</button>
                                            </form>
                                        </div>
                                    @elseif ($transaction->status === 'failed')
                                        <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus Transaksi</button>
                                        </form>
                                    @else
                                        <a
                                            href="{{ route('member.transaction.view-transaction', $transaction->transaction_code) }}"class="btn btn-primary">Cek
                                            Transaksi</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border my-4" id="sentinel"role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('components.includes.member.sidebar-dashboard-mobile')
@endsection
@push('addon-script')
    <script src="{{ asset('nemolab/member/js/scroll-dashboard.js') }}"></script>
    <script>
        let loading = false;
        let lastBookId = null;
        let lastCourseId = null;
        let hasMore = true;

        // Mendapatkan elemen grid container
        const gridContainer = document.querySelector('.courses-scroll');
        // Mendapatkan nilai grid-template-columns
        const gridTemplateColumns = window.getComputedStyle(gridContainer).getPropertyValue(
            'grid-template-columns');
        // Menghitung jumlah kolom
        const totalColumns = gridTemplateColumns.split(' ').length;

        function loadMoreContent() {
            if (loading || !hasMore) return;

            loading = true;
            const urlParams = new URLSearchParams(window.location.search);
            const filter = urlParams.get('filter');

            fetch(`${window.location.pathname}?${new URLSearchParams({
                'filter': filter,
                'lastBookId': lastBookId,
                'lastCourseId': lastCourseId,
                'itemsPerRow': totalColumns,
            })}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => response.json()).then(response => {
                const container = document.querySelector('.courses-scroll');
                hasMore = response.hasMore;

                if (Array.isArray(response.data)) {
                    response.data.forEach(item => {
                        const itemHtml = createItemHtml(item);
                        container.insertAdjacentHTML('beforeend', itemHtml);
                    });

                    if (!hasMore && lastCourseId == null && response.data.length < totalColumns) {
                        document.querySelector('.courses-scroll')
                            .style.gridTemplateColumns = 'repeat(auto-fit, minmax(250px, 280px))';
                    }
                } else if (lastCourseId == null) {
                    container.insertAdjacentHTML(
                        'beforeend',
                        `<div class="col-md-12 d-flex justify-content-center align-items-center">
                            <div class="not-found text-center">
                                <img src="{{ asset('nemolab/member/img/search-not-found.png') }}"
                                    class="logo-not-found w-50 h-50" alt="Not Found">
                                <p class="mt-3">Kelas Tidak Tersedia</p>
                            </div>
                        </div>`
                    );
                }

                lastBookId = response.lastBookId;
                lastCourseId = response.lastCourseId;
                document.querySelector('#sentinel').style.display = hasMore ? 'block' : 'none';
                loading = false;
                SetLineClamp()
            }).catch(error => {
                console.error('Error:', error);
                loading = false;
            });
        }

        function createItemHtml(item) {

            return `
                <a href="{{ route('member.course.join', '') }}/${item.slug}" class="card">
                    ${item.cover !=null ? `<img src="{{ url('/') }}/storage/images/covers/${item.cover}"" class="card-img-top d-block" alt="...">` : `<img  src="{{ url('/') . asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top d-block" alt="...">` }
                    <div class="card-body">
                        <div class="title-card title-link">
                            <p>${item.category}</p>
                            <h5 class="fw-bold truncate-text" style="max-height:none;">${item.name}</h5>
                        </div>
                        <p class="tipe" style="color: #666666">${item.product_type} ${item.type}</p>
                        <div
                            class="btn-group-harga d-flex justify-content-between align-items-center gap-1 gap-md-0">
                            ${item.type == 'free' ? '' : 
                                `<div class="harga d-block"><p class="p-0 m-0 d-flex d-md-block gap-2 ">Status: <br class="d-md-block"><span style="color: #666666">${item.status}</span></p></div>`
                            }
                            <div class="harga d-block">
                                <p class="p-0 m-0 d-flex d-md-block gap-2">Bergabung: <br class="d-md-block">
                                    <span
                                        style="color: #666666">${formatDate(item.mylist[0].created_at)}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            `
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const locale = navigator.language; // Mendapatkan locale dari perangkat pengguna
            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
            };
            return date.toLocaleString(locale, options).replace(/ /g, '-').replace(',', '');
        }

        // Intersection Observer untuk infinite scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loadMoreContent();
                }
            });
        }, {
            threshold: 0.5
        });

        // Mengamati elemen sentinel
        const sentinel = document.querySelector('#sentinel');
        if (sentinel) {
            observer.observe(sentinel);
        }

        loadMoreContent();
    </script>
@endpush