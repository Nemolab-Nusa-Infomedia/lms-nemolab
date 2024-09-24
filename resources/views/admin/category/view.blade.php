@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Category')

@section('content')
    <main class="col-md-12 ml-sm-auto col-lg-9 ps-4">
        <h1 class="judul-table mb-3">Kategori</h1>
        <div class="table-responsive p-3">
            <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center ms-3 mt-2">
                    <p class="mb-0 me-2">Menunjukkan</p>
                    <form method="GET" action="{{ route('admin.category') }}" id="entries-form">
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
                <a href="{{ route('admin.category.create') }}" class="tambah-data pt-2 pb-2 px-4 text-center fw-semibold"
                    style="width: max=content; !important">Tambah</a>
            </div>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('admin.category.edit', $item->id) }}" class="me-2">
                                    <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="" width="35"
                                        height="35">
                                </a>
                                <a href="{{ route('admin.category.delete', $item->id) }} " id="btn-delete">
                                    <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""width="35"
                                        height="35" id="btn-delete">
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">Belum ada data kategori</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between p-1">
                <p class="show">Menampilkan {{ $categories->count() }} dari {{ $categories->total() }}</p>
                <div class="d-flex gap-3">
                    <button class="pagination mx-1 {{ $categories->onFirstPage() ? 'disabled' : '' }}" id="prev-button"
                        {{ $categories->onFirstPage() ? 'disabled' : '' }}
                        data-url="{{ $categories->previousPageUrl() }}">Sebelumnya</button>
                    <button class="pagination mx-1 {{ $categories->hasMorePages() ? '' : 'disabled' }}" id="next-button"
                        {{ $categories->hasMorePages() ? '' : 'disabled' }}
                        data-url="{{ $categories->nextPageUrl() }}">Berikutnya</button>
                </div>
            </div>
        </div>
    </main>
        {{-- <!-- Popup YouTube -->
        <div id="youtube-popup" class="youtube-popup hidden">
            <iframe id="youtube-iframe"src="" frameborder="0" allowfullscreen></iframe>
            <img id="close-btn" class="close-btn" src="{{asset('nemolab/admin/img/close.png')}}" alt="">
        </div> --}}
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
                    text: "Apakah Anda Yakin Delete Kategori?",
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
