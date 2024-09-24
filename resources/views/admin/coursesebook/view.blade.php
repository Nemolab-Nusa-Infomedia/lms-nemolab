@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush
@section('title', 'View eBooks')
@section('content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-9 ps-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
            <h1 class="judul-table">eBooks</h1>
        </div>
        <div style="position: relative">
            <a href="{{ route('admin.ebook.create') }}" class="tambah-data pt-2 pb-2 px-4 fw-semibold"
               style="width: max-content; position: absolute; right: 15px; top: 15px; z-index: 999;">
                Tambah
            </a>
            <div class="d-flex gap-3" style="position: absolute; right: 20px; bottom: 30px;">
                <button class="pagination mx-1 {{ $ebooks->onFirstPage() ? 'disabled' : '' }}" id="prev-button"
                    {{ $ebooks->onFirstPage() ? 'disabled' : '' }}
                    data-url="{{ $ebooks->previousPageUrl() }}">Sebelumnya</button>
                <button class="pagination mx-1 {{ $ebooks->hasMorePages() ? '' : 'disabled' }}" id="next-button"
                    {{ $ebooks->hasMorePages() ? '' : 'disabled' }}
                    data-url="{{ $ebooks->nextPageUrl() }}">Selanjutnya</button>
            </div>
            <div class="table-responsive px-3 py-3">
                <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center ms-3 mt-2">
                        <p class="mb-0 me-2">Show</p>
                        <form method="GET" action="{{ route('admin.ebook') }}" id="entries-form">
                            <select id="entries" name="per_page" class="form-select form-select-sm rounded-3"
                                onchange="document.getElementById('entries-form').submit();">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                        <p class="mb-0 ms-2">entries</p>
                    </div>
                </div>
    
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kursus</th>
                            <th>Deskripsi</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th>Tampilan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ebooks as $ebook)
                        <tr>
                            <td>{{ $ebook->name }}</td>
                            <td>{{ $ebook->course ? $ebook->course->name : 'Course Not Selected' }}</td>
                            <td>{{ $ebook->description }}</td>
                            <td>{{ $ebook->type }}</td>
                            <td>{{ $ebook->status }}</td>
                            <td>{{ $ebook->price }}</td>
                            <td><a href="">lihat</a></td>
                            <td>
                                <a href="{{ route('admin.ebook.edit', $ebook->id) }}" class="me-2">
                                    <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="Edit" width="30" height="30">
                                </a>
                                <a href="{{ route('admin.ebook.delete', $ebook->id) }}">
                                    <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt="Delete" width="30" height="30">
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8">Belum Ada Buku Ditambahkan</td>
                            </tr>
                        @endforelse
                    </tbody>  
                </table>
                <div class="d-flex justify-content-between p-1">
                    <p class="show">Menampilkan {{ $ebooks->count() }} of {{ $ebooks->total() }}</p>
                </div>
            </div>
        </div>
    </main>
@endsection

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