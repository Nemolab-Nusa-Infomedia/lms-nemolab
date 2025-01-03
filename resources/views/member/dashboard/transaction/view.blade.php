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
                    <div class="filter-transaction">
                        <ul class="nav-tabs">
                            <li><a href="{{ route('member.transaction', ['status' => null]) }}"
                                class="{{ request('status') == null || !request('status') ? 'active' : '' }}">Semua</a></li>
                            <li><a href="{{ route('member.transaction', ['status' => 'success']) }}"
                                    class="{{ request('status') == 'success' ? 'active' : '' }}">Berhasil</a></li>
                            <li><a href="{{ route('member.transaction', ['status' => 'pending']) }}"
                                    class="{{ request('status') == 'pending' ? 'active' : '' }}">Pending</a></li>
                            <li><a href="{{ route('member.transaction', ['status' => 'failed']) }}"
                                    class="{{ request('status') == 'failed' ? 'active' : '' }}">Gagal</a></li>
                        </ul>
                    </div>
                    <div class="mt-4 transactions-scroll">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border my-4" id="sentinel" role="status">
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
<script>
    let loading = false;
    let lastId = null;
    let hasMore = true;

    function loadMoreContent() {
        if (loading || !hasMore) return;

        loading = true;
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        fetch(`${window.location.pathname}?${new URLSearchParams({
            'status': status,
            'lastId': lastId
        })}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(response => response.json()).then(response => {
            const container = document.querySelector('.transactions-scroll');
            hasMore = response.hasMore;

            if (Array.isArray(response.data) && response.data.length > 0) {
                response.data.forEach(item => {
                    const itemHtml = createTransactionHtml(item);
                    container.insertAdjacentHTML('beforeend', itemHtml);
                });
            } else if (lastId == null) {
                container.insertAdjacentHTML(
                    'beforeend',
                    `<div class="col-md-12 d-flex justify-content-center align-items-center">
                        <div class="not-found text-center">
                            <img src="{{ asset('nemolab/member/img/search-not-found.png') }}"
                                class="logo-not-found w-50 h-50" alt="Not Found">
                            <p class="mt-3">Tidak Ada Transaksi</p>
                        </div>
                    </div>`
                );
            }

            lastId = response.lastId;
            document.querySelector('#sentinel').style.display = hasMore ? 'block' : 'none';
            loading = false;
        }).catch(error => {
            console.error('Error:', error);
            loading = false;
        });
    }

    function createTransactionHtml(transaction) {
        const coverPath = transaction.course ? 
            `{{ url('/') }}/storage/images/covers/${transaction.course.cover}` :
            (transaction.ebook ? 
                `{{ url('/') }}/storage/images/covers/${transaction.ebook.cover}` :
                (transaction.bundle?.course ? 
                    `{{ url('/') }}/storage/images/covers/${transaction.bundle.course.cover}` :
                    `{{ url('/') . asset('nemolab/member/img/NemolabBG.jpg') }}`));

        const productType = transaction.bundle?.course ? 'Paket' :
            (transaction.ebook ? 'E-Book' : 'Kelas');

        const actionButtons = transaction.status === 'pending' ?
            `<div class="d-flex gap-2">
                <form action="{{ route('member.transaction.cancel', '') }}/${transaction.id}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Batalkan Pembelian</button>
                </form>
                <form action="{{ route('member.transaction.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="${transaction.course_id}">
                    <input type="hidden" name="ebook_id" value="${transaction.ebook_id}">
                    <input type="hidden" name="bundle_id" value="${transaction.bundle_id}">
                    <input type="hidden" name="price" value="${transaction.price}">
                    <input type="hidden" name="termsCheck" value="1">
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </form>
            </div>` :
            (transaction.status === 'failed' ?
                `<form action="{{ route('member.transaction.cancel', '') }}/${transaction.id}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Transaksi</button>
                </form>` :
                `<a href="{{ route('member.transaction.view-transaction', '') }}/${transaction.transaction_code}"
                    class="btn btn-primary">Cek Transaksi</a>`);

        return `
            <div class="card mt-3">
                <div class="card-body d-flex align-items-center">
                    <img alt="Product image" src="${coverPath}" height="80" width="120" class="cover me-3" style="object-fit: cover;" />
                    <div class="details">
                        <p class="title fw-bold">${transaction.name}</p>
                        <p class="Premium">${productType} ${transaction.price == 0 ? 'Gratis' : 'Premium'}</p>
                        <div class="info mt-2 row">
                            <div class="col-auto">
                                <p class="price fw-bold">Harga: Rp. ${new Intl.NumberFormat('id-ID').format(transaction.price)}</p>
                            </div>
                            <div class="col-auto">
                                <p class="date fw-bold">Tanggal: ${new Date(transaction.created_at).toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'})}</p>
                            </div>
                            <div class="col-auto">
                                <p class="status fw-bold">
                                    Status: 
                                    <span class="status-info" style="color: ${
                                        transaction.status === 'success' ? 'green' : 
                                        (transaction.status === 'pending' ? 'orange' : 'red')
                                    };">
                                        ${transaction.status.charAt(0).toUpperCase() + transaction.status.slice(1)}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="aksi d-flex mt-1 justify-content-end d-md-none">
                            ${actionButtons}
                        </div>
                    </div>
                    <div class="action d-none d-md-block">
                        ${actionButtons}
                    </div>
                </div>
            </div>
        `;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                loadMoreContent();
            }
        });
    }, {
        threshold: 0.5
    });

    const sentinel = document.querySelector('#sentinel');
    if (sentinel) {
        observer.observe(sentinel);
    }

    loadMoreContent();
</script>
@endpush