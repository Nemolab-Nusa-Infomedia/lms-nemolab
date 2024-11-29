@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Tambah Paket Video Ebook')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah Data</h2>
            <a href="{{ route('admin.paket-kelas') }}" class="btn btn-orange"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" id="formAction" action="{{ route('admin.paket-kelas.create.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <p>Cari Kursus Video</p>
                        <div class="custom-entryarea">
                            @if (is_null($courses) || $courses->isEmpty())
                                <span style="color: red">Maaf Belum Ada Kelas</span>
                            @else
                                <select id="courseSelect" name="name_course">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->name }}" data-price="{{ $course->price }}">
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            @error('name_course')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <p>Cari Kursus Ebook</p>
                        <div class="custom-entryarea">
                            @if (is_null($ebooks) || $ebooks->isEmpty())
                                <span style="color: red">Maaf Belum Ada Ebook</span>
                            @else
                                <select id="ebookSelect" name="name_ebook">
                                    @foreach ($ebooks as $ebook)
                                        <option value="{{ $ebook->name }}" data-price="{{ $ebook->price }}">
                                            {{ $ebook->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            @error('name_ebook')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="custom-entryarea">
                            <select id="type" name="type">
                                <option value="free">Gratis</option>
                                <option value="premium">Premium</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea d-none">
                            <input type="number" id="totalPrice" name="price" placeholder="" readonly/>
                            <div class="labelline">Harga</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                            style="background-color: #faa907">Kirim</button>
                    </div>
                </div>
            </form>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
    </div>
@endsection


@push('addon-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const courseSelect = document.getElementById('courseSelect');
    const ebookSelect = document.getElementById('ebookSelect');
    const priceInput = document.getElementById('totalPrice');
    const typeSelect = document.getElementById('type');

    const priceContainer = priceInput.closest('.entryarea');

    function updateTotalPrice() {
        const coursePrice = parseInt(courseSelect.selectedOptions[0].getAttribute('data-price'), 10) || 0;
        const ebookPrice = parseInt(ebookSelect.selectedOptions[0].getAttribute('data-price'), 10) || 0;

        if (typeSelect.value === 'premium') {
            priceContainer.classList.remove('d-none');

            let totalPrice = (coursePrice + ebookPrice) * 0.8;
            totalPrice = Math.max(totalPrice, 0);

            priceInput.value = Math.floor(totalPrice);
        } else {
            priceContainer.classList.add('d-none');
            priceInput.value = 0;
        }
    }
    courseSelect.addEventListener('change', updateTotalPrice);
    ebookSelect.addEventListener('change', updateTotalPrice);
    typeSelect.addEventListener('change', updateTotalPrice);
    updateTotalPrice();
});

</script>
@endpush
