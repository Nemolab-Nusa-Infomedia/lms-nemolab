@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Course')

@section('content')
    <main role="main" class="col-md-12 ml-sm-auto col-lg-9 ps-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
            <h1 class="judul-table">Courses Video</h1>
        </div>

        <div class="table-responsive px-3 py-3">
            <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center ms-3 mt-2">
                    <p class="mb-0 me-2">Show</p>
                    <form method="GET" action="{{ route('admin.course') }}" id="entries-form">
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
                <a href="{{ route('admin.course.create') }}" class="tambah-data pt-2 pb-2 px-4 fw-semibold"
                    style="width: max=content; !important">Tambah</a>
            </div>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Title</th>
                        <th>Deskripsi</th>
                        <th>Mentor</th>
                        <th>images</th>
                        <th>price</th>
                        <th>status</th>
                        <th>type</th>
                        <th>level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>{{ $course->category }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->description }}</td>
                            <td>{{ Auth::user()->name }}</td>
                            <td>
                                <img src="{{ asset('storage/images/covers/' . $course->cover) }}" alt=""
                                    width="150" height="100">
                            </td>
                            <td>Rp. {{ number_format($course->price, 0) }}</td>
                            <td>{{ $course->status }}</td>
                            <td>{{ $course->type }}</td>
                            <td>{{ $course->level }}</td>
                            <td class="">
                                {{-- <a href="{{ route('admin.ebook.create') }}" class="btn btn-warning text-white mb-2">
                                    Tambah ebook
                                </a> --}}
                                <a href="{{ route('admin.chapter', $course->slug) }}" class="btn btn-success mb-2">
                                    View Chapter
                                </a>
                                <a href="{{ route('admin.course.edit', $course->id) }}" class="me-2">
                                    <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="" width="30"
                                        height="30">
                                </a>
                                <a href="{{ route('admin.course.delete', $course->id) }}" id="btn-delete">
                                    <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""width="30"
                                        height="30">
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">Data Belum Ada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between p-1">
                <p class="show">Showing {{ $courses->count() }} of {{ $courses->total() }}</p>
                <div class="d-flex gap-3">
                    <button class="pagination mx-1 {{ $courses->onFirstPage() ? 'disabled' : '' }}" id="prev-button"
                        {{ $courses->onFirstPage() ? 'disabled' : '' }}
                        data-url="{{ $courses->previousPageUrl() }}">Previous</button>
                    <button class="pagination mx-1 {{ $courses->hasMorePages() ? '' : 'disabled' }}" id="next-button"
                        {{ $courses->hasMorePages() ? '' : 'disabled' }}
                        data-url="{{ $courses->nextPageUrl() }}">Next</button>
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
    <script>
        const btnDelete = document.querySelectorAll('#btn-delete')
        btnDelete.forEach(e => {
            e.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor click behavior

                const url = this.href; // Get the URL from the button's href attribute
                Swal.fire({
                    title: 'Delete',
                    text: "Apakah Anda Yakin Delete Course?",
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
