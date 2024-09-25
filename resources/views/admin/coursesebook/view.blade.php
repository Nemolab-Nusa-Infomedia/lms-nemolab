@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View eBooks')

@section('content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-9 ps-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1">
            <h1 class="judul-table">eBook Kursus</h1>
        </div>
        <div class="table-responsive px-3 py-3">
            <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-2 text-center">Menampilkan</p>
                    <select id="entries" class="form-select form-select-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <p class="mb-0 me-2 text-center mx-2">entri</p>
                </div>
                <a href="{{ route('admin.chapter.create', ['slug' => $slug, 'id_course' => $id]) }}"
                    class="tambah-data pt-2 pb-2 px-4 fw-semibold" style="width: max=content; !important">Tambah</a>
            </div>

            <div class="table-responsive px-3 py-3">
                <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('admin.ebook.create') }}" class="tambah-data pt-2 pb-2 px-4 fw-semibold"
                        style="width: max-content !important">Tambah eBook</a>
                </div>

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th>Link</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ebooks as $ebook)
                            <tr>
                                <td>{{ $ebook->name }}</td>
                                <td>{{ $ebook->description }}</td>
                                <td>{{ $ebook->type }}</td>
                                <td>{{ $ebook->status }}</td>
                                <td>{{ $ebook->price }}</td>
                                <td><a href="{{ $ebook->link }}" target="_blank">lihat</a></td>
                                <td>
                                    <a href="{{ route('admin.ebook.edit', $ebook->id) }}" class="me-2">
                                        <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="" width="30"
                                            height="30">
                                    </a>
                                    <a href="{{ route('admin.ebook.delete', $ebook->id) }}">
                                        <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""
                                            width="30" height="30">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Belum ada data ebook</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between px-1 py-1">
                <p class="show">Menampilkan 10 dari 10</p>
                <div class="d-flex">
                    <button class="pagination mx-1" id="prev-button">Sebelumnya</button>
                    <button class="pagination mx-1" id="next-button">Berikutnya</button>
                </div>
            </div>
        </div>
    </main>
    <!-- Popup YouTube -->
    {{-- <div id="youtube-popup" class="youtube-popup hidden">
        <iframe id="youtube-iframe"src="" frameborder="0" allowfullscreen></iframe>
        <img id="close-btn" class="close-btn" src="{{asset('nemolab/admin/img/close.png')}}" alt="">
    </div> --}}
@endsection
