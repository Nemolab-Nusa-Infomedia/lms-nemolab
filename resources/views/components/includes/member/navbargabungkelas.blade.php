    <!-- Navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg fixed-top bg-white px-5">
          <div class="container-fluid py-2">
            <a class="navbar-brand" href="#">
              <img src="{{asset('nemolab/assets/image/logo.png')}}" alt="Logo" width="110" class="d-inline-block align-text-top" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto gap-4">
                <li class="nav-item pt-lg-0 pt-sm-4 pt-4">
                  <a class="nav-link" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Course</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Contact Us</a>
                </li>
              </ul>
              <hr />
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('nemolab/assets/image/avatar.png')}}" alt="" width="40" class="d-md-block d-lg-none" />
                <p class="fw-semibold m-0">Halo, User</p>
                <img src="{{asset('nemolab/assets/image/avatar.png')}}" alt="" width="40" class="d-none d-lg-block" />
              </div>
            </div>
          </div>
        </nav>
      </div>