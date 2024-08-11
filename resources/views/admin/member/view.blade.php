@extends('components.layouts.admin.app')
@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/category.css') }}">
@endpush
@section('title', 'View Member-Data')

@section('content')
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">

<div class="container pe-0 col-9" id="datamember">
    <!-- Content -->            
    <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
            <h1 class="judul-table">Data Member</h1>
        </div>

        <div class="table-responsive px-3 py-3">
            <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-2 text-center">Show</p>
                    <form method="GET" action="{{ route('admin.member') }}" id="entries-form">
                        <select id="entries" name="entries" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    <p class="mb-0 me-2 text-center mx-2">entries</p>
                </div>
                <a href="{{ route('admin.member.create') }}" class="tambah-data px-2 py-2">Tambah</a>
            </div>
            
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>******</td>
                            <td>
                                <a href="{{ route('admin.member.edit', $student->id) }}" class="me-2">
                                    <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="" width="35"
                                        height="35">
                                </a>
                                <a href="{{ route('admin.member.destroy', $student->id) }}">
                                    <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""width="35"
                                        height="35">
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="d-flex justify-content-between px-1 py-1">
                <p class="show">Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }}</p>
                <div class="d-flex">
                    <!-- Custom Pagination -->
                    <button class="pagination mx-1 {{ $students->onFirstPage() ? 'disabled' : '' }}" id="prev-button" {{ $students->onFirstPage() ? 'disabled' : '' }} data-url="{{ $students->previousPageUrl() }}">Previous</button>
                    <button class="pagination mx-1 {{ $students->hasMorePages() ? '' : 'disabled' }}" id="next-button" {{ $students->hasMorePages() ? '' : 'disabled' }} data-url="{{ $students->nextPageUrl() }}">Next</button>
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
