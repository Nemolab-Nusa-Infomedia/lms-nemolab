@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'Lihat Video Ebook ')

@section('content')
    <div class="container-fluid px-2 px-sm-5 mt-5">
        <div class="row ">
            @include('components.includes.admin.sidebar')

            <div class="col-12 col-lg-9 ps-xl-3 d-flex justify-content-center" style="height: 600px">
                <div class="table-responsive shadow-lg rounded-3 p-3 w-100" style="background-color: #ffffff;">
                    <a href="{{ route('admin.paket-kelas.create') }}" class="btn"
                        style="background-color: #faa907; color: white; border-radius: 10px; padding: 6px 10px;">Tambahkan
                        Data</a>
                    <table class=" table table-bordered table-striped shadow-none mb-0" id="tablesContent">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama Kelas</th>
                                <th>Nama Ebook</th>
                                <th>Tipe</th>
                                {{-- <th>Status</th> --}}
                                <th>Harga</th>
                                @if (Auth::user()->role == 'superadmin')
                                    <th>Mentor</th>
                                @endif
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($paketKelas)
                                @forelse ($paketKelas as $kelas)
                                    <tr>
                                        {{-- nama course --}}
                                        @if (is_null($kelas->course))
                                            <td>-</td>
                                        @else
                                            <td>{{ $kelas->course->name }}</td>
                                        @endif

                                        {{-- nama ebook --}}
                                        @if (is_null($kelas->ebook))
                                            <td>-</td>
                                        @else
                                            <td>{{ $kelas->ebook->name }}</td>
                                        @endif

                                        {{-- tipe --}}
                                        <td>
                                            @if ($kelas->type == 'free')
                                                Gratis
                                            @else
                                                Berbayar
                                            @endif
                                        </td>

                                        {{-- status --}}
                                        {{-- <td>
                                        @if ($kelas->status == 'draft')
                                            Draf
                                        @else
                                            Publik
                                        @endif
                                    </td> --}}
                                        <td>Rp. {{ number_format($kelas->price, 0) }}</td>
                                        @if (Auth::user()->role == 'superadmin')
                                            @if (!is_null($users))
                                                <td>{{ $users->name }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                        @endif
                                        <td class="">
                                            <a class="btn btn-warning"
                                                href="{{ route('admin.paket-kelas.edit') }}?id={{ $kelas->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24"
                                                    style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                                    <path
                                                        d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z">
                                                    </path>
                                                    <path
                                                        d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.paket-kelas.delete') }}?id={{ $kelas->id }}"
                                                class="btn btn-danger ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('prepend-script')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
@endpush
