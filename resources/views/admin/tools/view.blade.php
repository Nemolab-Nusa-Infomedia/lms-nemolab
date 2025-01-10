@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'Lihat Tools ')

@section('content')
    <div class="container-fluid px-2 px-sm-5 mt-5">
        <div class="row ">
            @include('components.includes.admin.sidebar')

            <div class="col-12 col-lg-9 ps-xl-3 d-flex">
                <div class="table-responsive shadow-lg rounded-3 p-3 w-100" style="background-color: #ffffff;">
                    {{-- <a href="{{ route('admin.tools.create') }}" class="tambah-data"
                        >Tambahkan
                        Data</a> --}}
                        <button type="button" class="tambah-data" data-bs-toggle="modal" data-bs-target="#createModal">
                            Tambahkan Data
                        </button>

                        <!-- Modal -->
                    <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="border-0 modal-header">
                            <h1 class="modal-title fs-5" id="createModalLabel">Tambahkan Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formAction" action="{{ route('admin.tools.create.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="border-0 modal-body">
                                <!-- Nama Tools -->
                                <div class="mb-3">
                                    <label for="name_tools" class="form-label">Nama Tools<span class="required-field"></span></label>
                                    <input type="text" id="name_tools" name="name_tools" class="form-control" placeholder="Masukkan nama tools" />
                                    <span class="text-danger">@error('name_tools') {{ $message }} @enderror</span>
                                </div>
                            
                                <!-- Link -->
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link<span class="required-field"></span></label>
                                    <input type="text" id="link" name="link" class="form-control" placeholder="Masukkan link tools" />
                                    <span class="text-danger">@error('link') {{ $message }} @enderror</span>
                                </div>
                            
                                <!-- Gambar Alat -->
                                <div class="mb-3">
                                    <label for="logo_tools" class="form-label">Gambar Alat<span class="required-field"></span></label>
                                    <input type="file" id="logo_tools" name="logo_tools" accept="image/*" class="form-control" />
                                    <span class="text-danger">@error('logo_tools') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="border-0 modal-footer gap-3">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                    {{-- End Modal --}}
                    <table class=" table table-bordered table-striped shadow-none mb-0" id="tablesContent">
                        <thead class="table-dark">
                            <tr>
                                <th>Judul</th>
                                <th>Link</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tools as $item)
                                <!-- Modal Update -->
                                <div class="modal fade" id="updateModal{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="border-0 modal-header">
                                                <h1 class="modal-title fs-5" id="updateModalLabel{{ $item->id }}">Edit Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.tools.edit.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="border-0 modal-body">
                                                    <!-- Nama Tools -->
                                                    <div class="mb-3">
                                                        <label for="name_tools{{ $item->id }}" class="form-label">Nama Alat<span class="required-field"></span></label>
                                                        <input type="text" id="name_tools{{ $item->id }}" name="name_tools" 
                                                            class="form-control" 
                                                            value="{{ old('name_tools', $item->name_tools) }}" 
                                                            placeholder="Masukkan nama tools">
                                                        @if($errors->has('name_tools') && old('id') == $item->id)
                                                            <span class="text-danger">{{ $errors->first('name_tools') }}</span>
                                                        @endif
                                                    </div>

                                                    <!-- Link -->
                                                    <div class="mb-3">
                                                        <label for="link{{ $item->id }}" class="form-label">Link<span class="required-field"></span></label>
                                                        <input type="text" id="link{{ $item->id }}" name="link" 
                                                            class="form-control" 
                                                            value="{{ old('link', $item->link) }}" 
                                                            placeholder="Masukkan link tools">
                                                        @if($errors->has('link') && old('id') == $item->id)
                                                            <span class="text-danger">{{ $errors->first('link') }}</span>
                                                        @endif
                                                    </div>

                                                    <!-- Gambar Alat -->
                                                    <div class="mb-3">
                                                        <label for="logo_tools{{ $item->id }}" class="form-label">Gambar Alat<span class="required-field"></span></label>
                                                        <input type="file" id="logo_tools{{ $item->id }}" name="logo_tools" 
                                                            accept="image/*" 
                                                            class="form-control">
                                                        @if($errors->has('logo_tools') && old('id') == $item->id)
                                                            <span class="text-danger">{{ $errors->first('logo_tools') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="border-0 modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <tr>
                                    <td>{{ $item->name_tools }}</td>
                                    <td><a href="{{ $item->link }}" style="font-size: 12px;" class="btn btn-success">Kunjungi</a></td>
                                    <td>
                                        <img src="{{ $item->logo_tools }}" alt="{{ $item->name_tools }}" height="25" class="rounded-2 object-fit-cover">
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-3">
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $item->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24"
                                                style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                                <path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path>
                                                <path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path>
                                            </svg>
                                        </button>
                                            <a href="{{ route('admin.tools.delete', $item->id) }}" class="btn btn-danger" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tools ini?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
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
    @if($errors->any())
        @if(old('_method') == 'put')
            <script>
            // For update modal
            document.addEventListener('DOMContentLoaded', function() {
                var modalId = '#updateModal{{ old("id") }}';
                var modal = new bootstrap.Modal(document.querySelector(modalId));
                modal.show();
            });
            </script>
        @else
            <script>
            // For create modal
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.querySelector('#createModal'));
                modal.show();
            });
            </script>
        @endif
    @endif
@endpush

