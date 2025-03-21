@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'Lihat Data Mentor')

@section('content')
    <div class="container-fluid px-2 px-sm-5 mt-5">
        <div class="row ">
            @include('components.includes.admin.sidebar')

            <div class="col-12 col-lg-9 ps-xl-3 d-flex">
                <div class="table-responsive shadow-lg rounded-3 p-3 w-100" style="background-color: #ffffff;">
                    {{-- <a href="{{ route('admin.mentor.create') }}" class="tambah-data"
                        >Tambahkan
                        Data</a> --}}
                        <button type="button" class="tambah-data" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Tambahkan Data
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="border-0 modal-header">
                                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.mentor.store') }}" method="post" enctype="multipart/form-data">
                                <div class="border-0 modal-body">
                                  @csrf
                                    <!-- Nama -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                
                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="row">
                                        <!-- Password -->
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Masukkan password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Profession -->
                                    <div class="col-md-6">
                                        <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                                        <select id="profession" name="profession" class="form-select">
                                            <option value="">--Pilih profesi--</option>
                                            <option value="UI/UX Designer">UI/UX Designer</option>
                                            <option value="Frontend Developer">Frontend Developer</option>
                                            <option value="Backend Developer">Backend Developer</option>
                                            <option value="Wordpress Developer">Wordpress Developer</option>
                                            <option value="Graphics Designer">Graphics Designer</option>
                                            <option value="Fullstack Developer">Fullstack Developer</option>
                                        </select>
                                        @error('profession')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>
                                <div class="border-0 modal-footer">
                                  <button type="submit" class="btn btn-primary">Tambah</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                              </div>
                            </div>
                          </div>
                    <table class=" table table-bordered table-striped shadow-none mb-0" id="tablesContent">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Profession</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mentors as $mentor)
                            <!-- Modal -->
                            <div class="modal fade" id="updateModal{{ $mentor->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateModal{{ $mentor->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="border-0 modal-header">
                                    <h1 class="modal-title fs-5" id="updateModal{{ $mentor->id }}Label">Edit Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.mentor.update', $mentor->id) }}" method="post" enctype="multipart/form-data">
                                    <div class="border-0 modal-body">
                                    @csrf
                                    @method('put')
                                        <!-- Nama -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $mentor->name) }}" placeholder="Masukkan nama">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                    
                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $mentor->email) }}" placeholder="Masukkan email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="row">
                                            <!-- Password -->
                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="(biarkankosong jika tidak berubah)">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Profession -->
                                        <div class="col-md-6">
                                            <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                                            <select id="profession" name="profession" class="form-select">
                                                <option value="">--Pilih profesi--</option>
                                                <option value="UI/UX Designer"
                                                    {{ 'UI/UX Designer' == $mentor->profession ? 'selected' : '' }}>UI/UX Designer</option>
                                                <option value="Frontend Developer"
                                                    {{ 'Frontend Developer' == $mentor->profession ? 'selected' : '' }}>Frontend Developer
                                                </option>
                                                <option value="Backend Developer"
                                                    {{ 'Backend Developer' == $mentor->profession ? 'selected' : '' }}>Backend Developer
                                                </option>
                                                <option value="Wordpress Developer"
                                                    {{ 'Wordpress Developer' == $mentor->profession ? 'selected' : '' }}>Wordpress Developer
                                                </option>
                                                <option value="Graphics Designer"
                                                    {{ 'Graphic Designer' == $mentor->profession ? 'selected' : '' }}>Graphics Designer
                                                </option>
                                                <option value="Fullstack Developer"
                                                    {{ 'Fullstack Developer' == $mentor->profession ? 'selected' : '' }}>Fullstack
                                                    Developer
                                                </option>
                                            </select>
                                            @error('profession')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
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
                                    <td>{{ $mentor->name }}</td>
                                    <td>{{ $mentor->email }}</td>
                                    <td>{{ $mentor->profession }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-3">
                                            <button class="btn btn-warning"
                                            data-bs-toggle="modal" data-bs-target="#updateModal{{ $mentor->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24"
                                                style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                                <path
                                                    d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z">
                                                </path>
                                                <path
                                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z">
                                                </path>
                                            </svg>
                                        </button>
                                        <a href="{{ route('admin.mentor.delete') }}?id={{ $mentor->id }}"
                                            class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mentor ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
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
