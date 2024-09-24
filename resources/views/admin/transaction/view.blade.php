@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Transaction')

@section('content')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/tabel.css') }}">

    <!-- Tabel -->
    <div class="col-lg-9 col-sm-12 px-4">
        <div class="mb-3">
            <h1 class="judul-table">Transaksi</h1>
        </div>

        <div class="table-responsive p-3 border border-2">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center ms-3 mt-2">
                    <p class="mb-0 me-2">Menampilkan</p>
                    <form method="GET" action="{{ route('admin.transaction') }}" id="entries-form">
                        <select id="entries" name="per_page" class="form-select form-select-sm rounded-3"
                            onchange="document.getElementById('entries-form').submit();">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    <p class="mb-0 ms-2">entri</p>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kursus</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        @if ($transaction->course)
                            <tr>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->course->name }}</td>
                                <td>{{ $transaction->created_at->format('d-M-Y') }}</td>
                                <td>Rp {{ number_format($transaction->course->price, 2, ',', '.') }}</td>
                                @if ($transaction->status === 'success')
                                    <td class="text-capitalize text-success">{{ ucfirst($transaction->status) }}</td>
                                @elseif($transaction->status === 'failed')
                                    <td class="text-capitalize text-danger">{{ ucfirst($transaction->status) }}</td>
                                @else
                                    <td class="text-capitalize text-warning">{{ ucfirst($transaction->status) }}</td>
                                @endif
                                <td>
                                    @if ($transaction->status == 'pending')
                                        <form action="{{ route('admin.transactions.accept', $transaction->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                        </form>
                                        <form action="{{ route('admin.transactions.cancel', $transaction->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                        </form>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6">Belum ada data transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between p-1">
                <p class="show">Menampilkan {{ $transactions->count() }} dari {{ $transactions->total() }}</p>
                <div class="d-flex gap-3">
                    <button class="pagination mx-1 {{ $transactions->onFirstPage() ? 'disabled' : '' }}" id="prev-button"
                        {{ $transactions->onFirstPage() ? 'disabled' : '' }}
                        data-url="{{ $transactions->previousPageUrl() }}">Sebelumnya</button>
                    <button class="pagination mx-1 {{ $transactions->hasMorePages() ? '' : 'disabled' }}" id="next-button"
                        {{ $transactions->hasMorePages() ? '' : 'disabled' }}
                        data-url="{{ $transactions->nextPageUrl() }}">Berikutnya</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup YouTube -->
    {{-- <div id="youtube-popup" class="youtube-popup hidden">
        <iframe id="youtube-iframe"src="" frameborder="0" allowfullscreen></iframe>
        <img id="close-btn" class="close-btn" src="{{asset('nemolab/admin/img/close.png')}}" alt="">
    </div> --}}
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
    </script>
@endsection
