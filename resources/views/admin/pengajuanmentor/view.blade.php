@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Pengajuan-Mentor')

@section('content')

    <link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">
    <div class="container pe-0 col-9" id="pengajuanmentor">

        <!-- Content -->
        <main role="main" class="col-lg-12 col-sm-12 ">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
                <h1 class="judul-table">Pengajuan Mentor</h1>
            </div>

            <div class="table-responsive px-3 py-3">
                <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 me-2 text-center">Show</p>
                        <form method="GET" action="{{ route('admin.mentor') }}" id="entries-form">
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
                </div>

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Total Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($mentors as $mentor)
                            <tr>
                                <td>{{ $mentor->name }}</td>
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-success me-2">
                                        Accept
                                    </a>
                                    <a href="" class="btn btn-danger">
                                        Reject
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No mentors found.</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>

                {{-- <div class="d-flex justify-content-between px-1 py-1">
                    <p class="show">Showing {{ $mentors->firstItem() }} to {{ $mentors->lastItem() }} of
                        {{ $mentors->total() }}</p>
                    <div class="d-flex">
                        <!-- Custom Pagination -->
                        <button class="pagination mx-1 {{ $mentors->onFirstPage() ? 'disabled' : '' }}" id="prev-button"
                            {{ $mentors->onFirstPage() ? 'disabled' : '' }}
                            data-url="{{ $mentors->previousPageUrl() }}">Previous</button>
                        <button class="pagination mx-1 {{ $mentors->hasMorePages() ? '' : 'disabled' }}" id="next-button"
                            {{ $mentors->hasMorePages() ? '' : 'disabled' }}
                            data-url="{{ $mentors->nextPageUrl() }}">Next</button>
                    </div>
                </div>
            </div> --}}
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
