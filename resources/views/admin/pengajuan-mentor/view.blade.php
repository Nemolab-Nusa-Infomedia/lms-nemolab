@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'Lihat Data Pengajuan Mentor')

@section('content')
    <div class="container-fluid px-2 px-sm-5 mt-5">
        <div class="row ">
            @include('components.includes.admin.sidebar')

            <div class="col-12 col-lg-9 ps-xl-3 d-flex justify-content-center" style="height: 600px">
                <div class="table-responsive shadow-lg rounded-3 p-3 w-100" style="background-color: #ffffff;">
                    <table class=" table table-bordered table-striped shadow-none mb-0" id="tablesContent">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah Kursus</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mentorsWithCourses as $data)
                                @if ($data['total_course'] > 5)
                                    <tr>
                                        <td class="text-capitalize">{{ $data['mentor']->name }}</td>
                                        <td class="text-capitalize">{{ $data['total_course'] }}</td>
                                        <td>
                                            @if ($data['submission_status'] != 'accept')
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalUser-{{ $loop->iteration }}">
                                                    Kirim Pengajuan
                                                </button>
                                            @else
                                                <p class="btn btn-success me-2 disabled">
                                                    Pengajuan Terkirim
                                                </p>
                                            @endif
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalUser-{{ $loop->iteration }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('admin.pengajuan.store', $data['mentor']->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form
                                                                    Pengajuan Mentor
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div
                                                                    class="mb-3 d-flex justify-content-start align-items-start flex-column">
                                                                    <label for="form-link" class="">Link</label>
                                                                    <input type="url" class="form-control"
                                                                        name="link" id="form-link"
                                                                        placeholder="Masukan link Google Form" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="action" value="accept"
                                                                    class="btn btn-success me-2">Kirim Pengajuan
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
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
