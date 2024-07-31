<div class="container">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="{{asset('nemolab/assets/image/LogoNemolabClear.png')}}" alt="Logo" width="35  " height="35"
            class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item pt-lg-0 pt-sm-4">
              <a class="nav-link active fw-bold" aria-current="page" href="#" style="color:#faa907;"> <img class="me-3" src="{{asset('nemolab/assets/image/chevron-left.png')}}" alt="">@yield('back')</a>
            </li>
          </ul>
          <hr class="d-none d-sm-block">
          <p class="fw-bold my-auto me-2 ">Halo, Veroo</p>
          <img class="my-auto" src="{{asset('nemolab/assets/image/profile2.png')}}" style="width:4%;" alt="">
        </div>
      </div>
    </nav>
  </div>