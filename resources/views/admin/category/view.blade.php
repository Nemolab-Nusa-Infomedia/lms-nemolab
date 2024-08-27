@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Category')

@section('content')
    <main class="col-md-12 ml-sm-auto col-lg-9 ps-4">
        <h2 class="fw-semibold mb-4" style="color: #faa907;">Category</h2>
        <div class="table-responsive p-3">
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
                <a href="{{ route('admin.category.create') }}" class="tambah-data pt-2 pb-2 px-4 fw-semibold"
                    style="width: max=content; !important">Tambah</a>
            </div>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Action</th>
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
                                <a href="{{ route('admin.category.delete', $item->id) }}">
                                    <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""width="35"
                                        height="35">
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="2">Data Belum Ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-between p-1">
                    <p class="show">Showing {{ $categories->count() }} of {{ $categories->total() }}</p>
                    <div class="d-flex gap-3">
                        <button class="pagination mx-1 {{ $categories->onFirstPage() ? 'disabled' : '' }}" id="prev-button"
                            {{ $categories->onFirstPage() ? 'disabled' : '' }}
                            data-url="{{ $categories->previousPageUrl() }}">Previous</button>
                        <button class="pagination mx-1 {{ $categories->hasMorePages() ? '' : 'disabled' }}" id="next-button"
                            {{ $categories->hasMorePages() ? '' : 'disabled' }}
                            data-url="{{ $categories->nextPageUrl() }}">Next</button>
                    </div>
                </div>
            </div>
        </main>
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
