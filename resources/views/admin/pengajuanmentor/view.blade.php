@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Pengajuan Mentor')

@section('content')

    <link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">

    <!-- Content -->
    <main role="main" class="col-lg-9 col-sm-12 ps-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
            <h1 class="judul-table">Pengajuan Submission Mentor</h1>
        </div>

        <div class="table-responsive px-3 py-3">
            <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-2 text-center">Show</p>
                    <form method="GET" action="{{ route('admin.submissions') }}" id="entries-form">
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
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mentors as $mentor)
                        <tr>
                            <td class="text-capitalize">{{ $mentor->user->name }}</td>
                            <td class="text-capitalize">{{ $total_course }}</td>
                            <td class="text-capitalize">{{ $mentor->status }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Detail
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail pengajuan Mentor
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <p>Name : {{ $mentor->user->name }}</p>
                                                <p>Total Course : {{ $total_course }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form
                                                    action="{{ route('admin.submissions.edit.update', $mentor->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    @if ($mentor->status == 'pending')
                                                        <button type="submit" name="action" value="accept"
                                                            class="btn btn-success me-2">
                                                            Accept
                                                        </button>
                                                        <button type="submit" name="action" value="deaccept"
                                                            class="btn btn-danger">
                                                            Reject
                                                        </button>
                                                    @elseif ($mentor->status == 'accept')
                                                        <button disabled class="btn btn-success me-2">
                                                            Accepted
                                                        </button>
                                                    @elseif ($mentor->status == 'deaccept')
                                                        <button disabled class="btn btn-danger me-2">
                                                            Rejected
                                                        </button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <form action="{{ route('admin.submissions.edit.update', $mentor->user->id) }}"
                                    method="post">
                                    @csrf
                                    @method('put')
                                    @if ($mentor->status == 'pending')
                                        <button type="submit" name="action" value="accept" class="btn btn-success me-2">
                                            Accept
                                        </button>
                                        <button type="submit" name="action" value="deaccept" class="btn btn-danger">
                                            Reject
                                        </button>
                                    @elseif ($mentor->status == 'accept')
                                        <button disabled class="btn btn-success me-2">
                                            Accepted
                                        </button>
                                    @elseif ($mentor->status == 'deaccept')
                                        <button disabled class="btn btn-danger me-2">
                                            Rejected
                                        </button>
                                    @endif
                                </form> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak Ada Pengajuan Mentor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between px-1 py-1">
                {{-- <p class="show">Showing {{ $mentors->firstItem() }} to {{ $mentors->lastItem() }} of
                        {{ $mentors->total() }}</p>
                    <div class="d-flex">
                        <!-- Custom Pagination -->
                        <button class="pagination mx-1 {{ $mentors->onFirstPage() ? 'disabled' : '' }}" id="prev-button"
                            {{ $mentors->onFirstPage() ? 'disabled' : '' }}
                            data-url="{{ $mentors->previousPageUrl() }}">Previous</button>
                        <button class="pagination mx-1 {{ $mentors->hasMorePages() ? '' : 'disabled' }}" id="next-button"
                            {{ $mentors->hasMorePages() ? '' : 'disabled' }}
                            data-url="{{ $mentors->nextPageUrl() }}">Next</button>
                    </div> --}}
            </div>
        </div>
    </main>
    <!-- Popup YouTube -->
    {{-- <div id="youtube-popup" class="youtube-popup hidden">
        <iframe id="youtube-iframe"src="" frameborder="0" allowfullscreen></iframe>
        <img id="close-btn" class="close-btn" src="{{asset('nemolab/admin/img/close.png')}}" alt="">
    </div> --}}
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
