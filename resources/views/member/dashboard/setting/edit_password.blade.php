@extends('components.layouts.member.navback')

@section('content')
<link rel="stylesheet" href="{{ asset('nemolab/member/css/edit.css') }}">

<div class="container">
    <div class="row">
        <div class="col-12 mt-4 d-flex justify-content-center">
            <div class="box bg-white rounded-4">
                <h4 class="fw-semibold" style="color: #faa907; margin-bottom: 2rem">Edit Password</h4>
                <form action="{{ route('member.update-password') }}" method="POST">
                    @csrf
                    <div class="input">
                        <label for="old-password">Password Lama</label><br />
                        <input type="password" id="old-password" name="old_password" class="inp" />
                        @error('old_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input my-3">
                        <label for="new-password">Password Baru</label><br />
                        <input type="password" id="new-password" name="new_password" class="inp" />
                        @error('new_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input">
                        <label for="confirm-new-password">Konfirmasi Password Baru</label><br />
                        <input type="password" id="confirm-new-password" name="new_password_confirmation" class="inp" />
                    </div>
                    <div class="input mt-4">
                        <input type="submit" value="Simpan Password" class="inp button text-white fw-semibold rounded-5" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
