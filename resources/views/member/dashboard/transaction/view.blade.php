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
                    @foreach ($transactions as $transaction)
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
                            <img alt="Product image" src="{{ $coverPath }}" height="80" width="120" class="cover me-3" style="object-fit: cover" />
                            <div class="details">
                                <p class="title" >{{ $transaction->name }}</p>
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
                                    <div class="info mt-2 d-flex">
                                        <p class="price">Harga: Rp. {{ number_format($transaction->price, 0, ',', '.') }}</p>
                                        <p class="date">Tanggal: {{ $transaction->created_at->format('d-M-Y') }}</p>
                                        <p class="status">Status:</p>
                                        <p class="status-info"
                                            style="color: {{ $transaction->status === 'success' ? 'green' : ($transaction->status === 'pending' ? 'orange' : 'red') }};">
                                            {{ ucfirst($transaction->status) }}
                                        </p>
                                    </div>
                                    <div class="aksi d-flex mt-1 justify-content-end d-md-none">
                                        @if ($transaction->status === 'pending')
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Batalkan
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
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus
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
                                                <button type="submit" class="btn btn-danger btn-sm">Batalkan Pembelian</button>
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
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus Transaksi</button>
                                        </form>
                                    @else
                                        <a
                                            href="{{ route('member.transaction.view-transaction', $transaction->transaction_code) }}"class="btn btn-primary">Cek
                                            Transaksi</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @include('components.includes.member.sidebar-dashboard-mobile')
@endsection
@push('addon-script')
    <script src="{{ asset('nemolab/member/js/scroll-dashboard.js') }}"></script>
@endpush