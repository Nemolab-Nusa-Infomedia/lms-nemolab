@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Chapter')

@section('content')

    <main role="main" class="col-md-12 ml-sm-auto col-lg-9 ps-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1">
            <h1 class="judul-table">Bab</h1>
            <p>
                <a href="{{ route('admin.course') }}">Kursus</a>
                / Bab
            </p>
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

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($chapters as $chapter)
                        <tr>
                            <td>{{ $chapter->name }}</td>
                            <td>
                                <a href="{{ route('admin.lesson', ['slug' => $slug, 'id_chapter' => $chapter->id]) }}"
                                    class="btn btn-success">
                                    Lihat Pelajaran
                                </a>
                                <a href="{{ route('admin.chapter.edit', ['slug' => $slug, 'id_chapter' => $chapter->id]) }}"
                                    class="me-2">
                                    <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="" width="30"
                                        height="30">
                                </a>
                                <a href="{{ route('admin.chapter.delete', $chapter->id) }}" id="btn-delete">
                                    <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""width="30"
                                        height="30">
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">Belum ada data bab</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

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
@push('addon-script')
    <script>
        const btnDelete = document.querySelectorAll('#btn-delete')
        btnDelete.forEach(e => {
            e.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor click behavior

                const url = this.href; // Get the URL from the button's href attribute
                Swal.fire({
                    title: 'Delete',
                    text: "Apakah Anda Yakin Delete Chapter?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to the delete URL
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endpush
