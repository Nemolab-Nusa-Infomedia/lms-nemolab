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
                    @if (Auth::user()->role == 'mentor')
                    {{-- <a href="{{ route('admin.paket-kelas.create') }}" class="tambah-data"
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
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambahkan Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formAction" action="{{ route('admin.paket-kelas.create.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="border-0 modal-body">
                                <!-- Cari Kursus Video -->
                                <div class="mb-3">
                                    <label for="courseSelect" class="form-label">Cari Kursus Video</label>
                                    <div>
                                        @if (is_null($courses) || $courses->isEmpty())
                                            <span class="text-danger">Maaf Belum Ada Kelas</span>
                                        @else
                                            <select id="courseSelect" name="name_course" class="form-select">
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->name }}" data-price="{{ $course->price }}">
                                                        {{ Str::limit($course->name, 57) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @error('name_course')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            
                                <!-- Cari Kursus Ebook -->
                                <div class="mb-3">
                                    <label for="ebookSelect" class="form-label">Cari Kursus Ebook</label>
                                    <div>
                                        @if (is_null($ebooks) || $ebooks->isEmpty())
                                            <span class="text-danger">Maaf Belum Ada Ebook</span>
                                        @else
                                            <select id="ebookSelect" name="name_ebook" class="form-select">
                                                @foreach ($ebooks as $ebook)
                                                    <option value="{{ $ebook->name }}" data-price="{{ $ebook->price }}">
                                                        {{ Str::limit($ebook->name, 57) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @error('name_ebook')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            
                                <!-- Pilihan Type -->
                                <div class="mb-3">
                                    <label for="type" class="form-label">Pilih Tipe</label>
                                    <select id="type" name="type" class="form-select">
                                        <option value="free">Gratis</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                                <!-- Harga -->
                                <div class="mb-3 d-none">
                                    <label for="totalPrice" class="form-label">Harga</label>
                                    <input type="number" id="totalPrice" name="price" class="form-control" placeholder="" readonly />
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
                    @endif
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
                                        <td>
                                            <div class="d-flex justify-content-center gap-3">
                                                @if (Auth::user()->role == 'mentor')
                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.paket-kelas.edit') }}?id={{ $kelas->id }}">
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
                                                </a>
                                                @endif
                                                <a href="{{ route('admin.paket-kelas.delete') }}?id={{ $kelas->id }}"
                                                    class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
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

@push('addon-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const courseSelect = document.getElementById('courseSelect');
        const ebookSelect = document.getElementById('ebookSelect');
        const priceInput = document.getElementById('totalPrice');
        const typeSelect = document.getElementById('type');

        // Container harga untuk kontrol visibilitas
        const priceContainer = priceInput.closest('.mb-3');

        // Fungsi untuk memperbarui total harga
        function updateTotalPrice() {
            const coursePrice = parseInt(courseSelect.selectedOptions[0]?.getAttribute('data-price'), 10) || 0;
            const ebookPrice = parseInt(ebookSelect.selectedOptions[0]?.getAttribute('data-price'), 10) || 0;

            if (typeSelect.value === 'premium') {
                // Tampilkan harga hanya jika tipe premium dipilih
                priceContainer.classList.remove('d-none');

                // Hitung total harga dengan diskon 20% (0.8)
                let totalPrice = (coursePrice + ebookPrice) * 0.8;
                totalPrice = Math.max(totalPrice, 0); // Pastikan tidak negatif

                // Perbarui input harga
                priceInput.value = Math.floor(totalPrice);
            } else {
                // Sembunyikan harga dan set ke 0 jika bukan premium
                priceContainer.classList.add('d-none');
                priceInput.value = 0;
            }
        }

        // Event listener untuk memperbarui harga
        courseSelect?.addEventListener('change', updateTotalPrice);
        ebookSelect?.addEventListener('change', updateTotalPrice);
        typeSelect?.addEventListener('change', updateTotalPrice);

        // Jalankan fungsi untuk set default saat halaman dimuat
        updateTotalPrice();
    });
</script>

@endpush
