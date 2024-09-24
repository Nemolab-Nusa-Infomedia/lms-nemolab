@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Portofolio')

@section('content')

    <link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">

    <!-- Content -->
    <main role="main" class="col-lg-9 col-sm-12 ps-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
            <h1 class="judul-table">Pengajuan Portofolio</h1>
        </div>

        <div class="table-responsive px-3 py-3">
            <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-2 text-center">Menampilkan</p>
                    <form method="GET" action="{{ route('admin.portofolio') }}" id="entries-form">
                        <select id="entries" name="entries" class="form-select form-select-sm"
                            onchange="document.getElementById('entries-form').submit()">
                            <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                        </select>

                    </form>
                    <p class="mb-0 me-2 text-center mx-2">entri</p>
                </div>
            </div>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Nama Anggota</th>
                        <th>Nama Kursus</th>
                        <th>Link Project</th>
                        {{-- <th>Date</th> --}}
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($portofolio as $porto)
                        <tr>
                            <td>{{ $porto->name_user }}</td>
                            <td>{{ $porto->name }}</td>
                            <td>
                                <a href="{{ $porto->link }}" class="btn btn-primary">Lihat</a>
                            </td>
                            <td>{{ $porto->status }}</td>
                            @if ($porto->status == 'check')
                                {{-- <td>
                                    <form action="{{ route('admin.portofolio.edit.update', $porto->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" name="action" value="accepted" class="btn btn-success me-2">
                                            Accept Portofolio
                                        </button>
                                        <button type="submit" name="action" value="deaccepted" class="btn btn-danger">
                                            Reject Portofolio
                                        </button>
                                    </form>
                                </td> --}}
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalUser-{{$loop->iteration}}">
                                        Detail
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalUser-{{$loop->iteration}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Portofolio
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p>Nama Anggota : {{ $porto->name_user }}</p>
                                                    <p>Nama Kursus : {{ $porto->name }}</p>
                                                    <p>Link Project : <a
                                                            href="{{ $porto->link }}">{{ $porto->link }}</a></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.portofolio.edit.update', $porto->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" name="action" value="accepted"
                                                            class="btn btn-success me-2">
                                                            Terima
                                                        </button>
                                                        <button type="submit" name="action" value="deaccepted"
                                                            class="btn btn-danger">
                                                            Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @elseif ($porto->status == 'accepted')
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Detail
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Portofolio
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p>Nama Anggota : {{ $porto->name_user }}</p>
                                                    <p>Nama Kursus : {{ $porto->name }}</p>
                                                    <p>Link Project : <a
                                                            href="{{ $porto->link }}">{{ $porto->link }}</a></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <p class="btn btn-success me-2 disabled m-0">
                                                        Diterima
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Detail
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Portofolio
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p>Nama Anggota : {{ $porto->name_user }}</p>
                                                    <p>Nama Kursus : {{ $porto->name }}</p>
                                                    <p>Link Project : <a
                                                            href="{{ $porto->link }}">{{ $porto->link }}</a></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <p class="btn btn-danger disabled m-0">
                                                        Ditolak
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Belum ada data pengajuan</td>
                        </tr>
                    @endforelse
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
