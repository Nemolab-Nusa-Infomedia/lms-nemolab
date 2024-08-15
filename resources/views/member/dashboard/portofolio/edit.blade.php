@extends('components.layouts.admin.create-update')

@push('prepend-style')
<link rel="stylesheet" href="{{ asset('nemolab/member/css/create-update.css') }}">
@endpush

@section('title', 'Edit Portofolio')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Edit Data</h2>
            <a href="{{ route('member.portofolio') }}" class="btn btn-orange"> Back </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('member.portofolio.edit.update', $porto->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder=""
                                value="{{ $porto->name }}" />
                            <div class="labelline" for="name">Nama Portofolio</div>
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="name" name="link" placeholder=""
                                value="{{ $porto->link }}" />
                            <div class="labelline" for="name">Link Portofolio</div>
                            @error('link')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="entryarea">
                        <textarea name="description" id="" cols="30" rows="10">{{ $porto->description }}
                        </textarea>
                    </div>
                    @error('description')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
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
