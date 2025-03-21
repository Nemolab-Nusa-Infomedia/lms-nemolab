@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'Lihat Lesson')

@section('content')
    <div class="container-fluid px-2 px-sm-5 mt-5">
        <div class="row ">
            @include('components.includes.admin.sidebar')

            <div class="col-12 col-lg-9 ps-xl-3">
                <div class="table-responsive shadow-lg rounded-3 p-3 w-100" style="background-color: #ffffff;">
                    <div class="link-group d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.chapter', $slug_course) }}" style="color: #faa907;"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-arrow-left-circle" viewBox="0 0 16 16" fill="#faa907">
                                <path fill-rule="evenodd"
                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                            </svg></a>
                        {{-- <a href="{{ route('admin.lesson.create', [$slug_course, $id_chapter]) }}" class="tambah-data"
                            >Tambahkan
                            Data</a> --}}
                            @if (Auth::user()->role == 'mentor')
                            <button type="button" class="tambah-data" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Tambahkan Data
                            </button>
                            @endif
                            <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="border-0 modal-header">
                                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.lesson.create.store', $id_chapter) }}" method="post">
                                <div class="border-0 modal-body">
                                  @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Judul Video<span class="required-field"></span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan judul video" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="video" class="form-label">Link Video<span class="required-field"></span></label>
                                    <input type="text" id="video" name="video" class="form-control" placeholder="Masukkan link video(Embed)" />
                                    @error('video')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                    </div>
                    <table class=" table table-bordered table-striped shadow-none mb-0" id="tablesContent">
                        <thead class="table-dark">
                            <tr>
                                <th>Judul</th>
                                <th>Episode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $lesson)
                                <!-- Modal Update -->
                                <div class="modal fade" id="updateModal{{ $lesson->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateModalLabel{{ $lesson->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="border-0 modal-header">
                                                <h1 class="modal-title fs-5" id="updateModalLabel{{ $lesson->id }}">Edit Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.lesson.edit.update', $lesson->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="border-0 modal-body">
                                                    <div class="mb-3">
                                                        <label for="name{{ $lesson->id }}" class="form-label">Judul Video<span class="required-field"></span></label>
                                                        <input type="text" id="name{{ $lesson->id }}" name="name" 
                                                            class="form-control" 
                                                            value="{{ old('name', $lesson->name) }}" 
                                                            placeholder="Masukkan judul video">
                                                        @if($errors->has('name') && old('id') == $lesson->id)
                                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="video{{ $lesson->id }}" class="form-label">Link Video<span class="required-field"></span></label>
                                                        <input type="text" id="video{{ $lesson->id }}" name="video" 
                                                            class="form-control" 
                                                            value="{{ old('video', $lesson->video) }}" 
                                                            placeholder="Masukkan link video(Embed)">
                                                        @if($errors->has('video') && old('id') == $lesson->id)
                                                            <span class="text-danger">{{ $errors->first('video') }}</span>
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
                                    <td>{{ $lesson->name }}</td>
                                    <td>
                                        <a href="{{ $lesson->video }}" style="font-size: 12px;" class="btn btn-success">Kunjungi Video</a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-3">
                                        @if (Auth::user()->role == 'mentor')
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $lesson->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24"
                                                    style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                                    <path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path>
                                                    <path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path>
                                                </svg>
                                            </button>
                                        @endif
                                        <a href="{{ route('admin.lesson.delete') }}?id={{ $lesson->id }}"
                                            class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus lesson ini?')">
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
@push('addon-script')
    <script>
        const btnDelete = document.querySelectorAll('#btn-delete')
        btnDelete.forEach(e => {
            e.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor click behavior

                const url = this.href; // Get the URL from the button's href attribute
                Swal.fire({
                    title: 'Delete',
                    text: "Apakah Anda Yakin Delete Lesson?",
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
        });
    </script>
@endpush
