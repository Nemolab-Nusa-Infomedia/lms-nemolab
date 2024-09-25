@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Forums')

@section('content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-9 ps-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
            <h1 class="judul-table">Forum</h1>
        </div>

        <div class="table-responsive px-3 py-3">
            <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center ms-3 mt-2">
                    <p class="mb-0 me-2">Menampilkan</p>
                    <form method="GET" action="{{ route('admin.forum') }}" id="entries-form">
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
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Sampul</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($forums as $forum)
                        <tr>
                            <td>
                                @if ($forum->course->cover)
                                    <img src="{{ asset('storage/images/covers/' . $forum->course->cover) }}" alt=""
                                        width="150" height="100" class="object-fit-cover rounded-3">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $forum->tittle }}</td>
                            <td>
                                <a href="{{ route('member.forum', ['slug' => $forum->course->slug]) }}" class="me-2 btn btn-primary">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Belum ada data forum</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-between p-1">
                <p class="show">Menampilkan {{ $forums->count() }} dari {{ $forums->total() }}</p>
                <div class="d-flex gap-3">
                    <button class="pagination mx-1 {{ $forums->onFirstPage() ? 'disabled' : '' }}" id="prev-button"
                        {{ $forums->onFirstPage() ? 'disabled' : '' }}
                        data-url="{{ $forums->previousPageUrl() }}">Sebelumnya</button>
                    <button class="pagination mx-1 {{ $forums->hasMorePages() ? '' : 'disabled' }}" id="next-button"
                        {{ $forums->hasMorePages() ? '' : 'disabled' }}
                        data-url="{{ $forums->nextPageUrl() }}">Berikutnya</button>
                </div>
            </div>
        </div>
    </main>

    @push('addon-script')
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
    @endpush
@endsection
