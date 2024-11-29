@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Edit Diskon Kelas')

@section('content')
    <div class="card mt-5 mb-5" style="border: none !important; ">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Edit Data</h2>
            <a href="{{ route('admin.diskon-kelas') }}" class="btn btn-orange"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" id="formAction" action="{{ route('admin.diskon-kelas.edit.update', $diskon->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-6 mt-4">
                        <div class="entryarea">
                            <input type="text" id="name" name="kode_diskon" placeholder=""
                                value="{{ $diskon->kode_diskon }}" />
                            <div class="labelline" for="link">Kode Diskon</div>
                            @error('kode_diskon')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-4">
                        <div class="entryarea">
                            <input type="number" id="name" name="rate_diskon" placeholder=""
                                value="{{ $diskon->rate_diskon }}" />
                            <div class="labelline" for="link">Rate Diskon</div>
                            @error('rate_diskon')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit"
                            class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                            style="background-color: #faa907">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const type = document.getElementById('type');
            const price = document.getElementById('price');
            // Pastikan elemen "type" sudah ada sebelum melanjutkan
            if (type) {
                if (type.value == 'premium') {
                    price.classList.replace('d-none', 'd-block');
                } else if (type.value == 'free') {
                    price.classList.replace('d-block', 'd-none')
                    price.querySelector('input[name="price"]').value = '0';
                }

                // Event listener untuk perubahan nilai pada "type"
                type.addEventListener('change', (e) => {
                    if (e.target.value == 'premium') {
                        price.classList.replace('d-none', 'd-block');
                    } else if (e.target.value == 'free') {
                        price.classList.replace('d-block', 'd-none');
                        price.querySelector('input[name="price"]').value = '0';
                    }
                });
            }
        });
    </script> --}}
@endpush
