@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Super Admin Data')

@section('content')

    <link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">

    <!-- Content -->
    <main role="main" class="col-lg-9 col-sm-12 ps-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
            <h1 class="judul-table">Super Admin Data</h1>
        </div>

        <div class="table-responsive px-3 py-3">
            <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-2 text-center">Show</p>
                    <form method="GET" action="{{ route('admin.superadmin') }}" id="entries-form">
                        <select id="entries" name="entries" class="form-select form-select-sm"
                            onchange="document.getElementById('entries-form').submit()">
                            <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                        </select>

                    </form>
                    <p class="mb-0 me-2 text-center mx-2">entries</p>
                </div>
                {{-- <a href="{{ route('admin.superadmin.create') }}" class="tambah-data pt-2 pb-2 px-4 fw-semibold"
                        style="width: max=content; !important">Tambah</a> --}}
            </div>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($superadmins as $superadmin)
                        <tr>
                            <td>{{ $superadmin->name }}</td>
                            <td>{{ $superadmin->email }}</td>
                            <td>****</td>
                            {{-- <td>
                                    <a href="{{ route('admin.superadmin.edit', $superadmin->id) }}" class="me-2">
                                        <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="" width="35"
                                            height="35">
                                    </a>
                                    <a href="{{ route('admin.superadmin.destroy', $superadmin->id) }}">
                                        <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""width="35"
                                            height="35">
                                    </a>
                                </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">There is no superadmin data yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between px-1 py-1">
                <p class="show">Showing {{ $superadmins->firstItem() }} to {{ $superadmins->lastItem() }} of
                    {{ $superadmins->total() }}</p>
                <div class="d-flex">
                    <!-- Custom Pagination -->
                    <button class="pagination mx-1 {{ $superadmins->onFirstPage() ? 'disabled' : '' }}" id="prev-button"
                        {{ $superadmins->onFirstPage() ? 'disabled' : '' }}
                        data-url="{{ $superadmins->previousPageUrl() }}">Previous</button>
                    <button class="pagination mx-1 {{ $superadmins->hasMorePages() ? '' : 'disabled' }}" id="next-button"
                        {{ $superadmins->hasMorePages() ? '' : 'disabled' }}
                        data-url="{{ $superadmins->nextPageUrl() }}">Next</button>
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
        document.getElementById('btn-delete').addEventListener('click', function(event) {
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
    </script>
@endpush
