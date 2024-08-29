@extends('components.layouts.member.navback')

@section('content')
<link rel="stylesheet" href="{{ asset('nemolab/member/css/edit.css') }}">

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="box bg-white rounded-4">
                <h4 class="fw-semibold" style="color: #faa907; margin-bottom: 2rem">Edit Profile</h4>
                <form action="{{ route('member.update-profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="input text-center">
<<<<<<< HEAD
    
                        <img src="{{ Auth::user()->avatar != 'default.png' ? asset('storage/images/avatars/' . Auth::user()->avatar) : asset('nemolab/admin/img/avatar.png') }}" id="preview" alt="" class="rounded-circle" width="90" height="90"/>
=======
                        <img src="{{ file_exists(storage_path('app/public/images/avatars/' . Auth::user()->avatar)) ? asset('storage/images/avatars/' . Auth::user()->avatar) : asset('nemolab/admin/img/avatar.png') }}" id="preview" alt="" class="rounded-circle" width="90" height="90"/>
>>>>>>> 362969dd865601912ea1f548072f14c2e8ecd27f
                    </div>
                    <div class="input mt-5 mb-2">
                        <input type="file" id="avatar" name="avatar" accept="image/*" class="custom-file-input" /><br />
                        <label for="avatar">Format file jpg, jpeg, png.</label>
                    </div>
                    <div class="input">
                        <label for="name">Full Name</label><br />
                        <input type="text" id="name" name="name" class="inp" value="{{ Auth::user()->name }}" />
                    </div>
                    <div class="input my-3">
                        <label for="email">Email Address</label><br />
                        <input type="text" id="email" name="email" class="inp" value="{{ Auth::user()->email }}" />
                    </div>
                    <div class="input">
                        <label for="username">Username</label><br />
                        <input type="text" id="username" name="username" class="inp" value="{{ Auth::user()->username }}" />
                    </div>
                    <div class="input mt-4">
                        <input type="submit" value="Save My Profile" class="inp button text-white fw-semibold rounded-5" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
