@extends('components.layouts.member.login&register')

@section('title, nemolab')

@section('content-register')
<div class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <div class="box rounded-5 bg-white text-center d-flex flex-column justify-content-center shadow-lg">
          <div>
            <img src="{{asset('nemolab/assets/image/logo.png')}}" alt="logo" width="130" />
          </div>
          <div>
            <img src="{{asset('nemolab/assets/image/avatar.png')}}" alt="avatar" width="105" height="105" style="border-radius: 50%; object-fit: cover" />
          </div>
          <form action="">
            <div class="input-col position-relative">
              <input type="email" placeholder="Name" />
              <span class="ikon"><img src="{{asset('nemolab/assets/image/user.png')}}" width="16" /></span>
            </div>
            <div class="input-col position-relative mt-2">
              <input type="file" id="fileInput" class="file-input" onchange="updateFileName()" />
              <label for="fileInput" class="file-label" data-placeholder="Choose avatar"></label>
              <span class="ikon"><img src="{{asset('nemolab/assets/image/avatar_2.png')}}" width="16" /></span>
            </div>
            <div class="input-col position-relative mt-2">
              <input type="email" placeholder="Email address" />
              <span class="ikon"><img src="{{asset('nemolab/assets/image/emailregister.png')}}" width="16" /></span>
            </div>
            <div class="input-col position-relative mt-2">
              <input type="password" placeholder="Password" id="password" />
              <span class="ikon"><img src="{{asset('nemolab/assets/image/password.png')}}"" width="16" /></span>
              <span class="eye"><img src="{{asset('nemolab/assets/image/eye.png')}}"" width="20" class="pass-icon opacity-25" id="pass-icon" onclick="pass()" /></span>
            </div>
          </form>
          <div class="d-grid gap-2">
            <button class="btn text-white fw-semibold">Continue</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection