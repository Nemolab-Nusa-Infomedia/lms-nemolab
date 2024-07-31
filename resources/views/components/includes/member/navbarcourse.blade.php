    <!-- NAVBAR -->
    <div class="container">
        <nav class="navbar navbar-expand-lg ">
          <div class="container-fluid">
              <a class="navbar-brand" href="#">
                  <img src="{{asset('nemolab/assets/image/LogoNemolab.png')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                      <li class="nav-item pt-lg-0 pt-sm-4">
                          <a class="nav-link active" aria-current="page" href="#">Home</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">Course</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="">About Us</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="">Contact Us</a>
                      </li>
                  </ul>
                  <div class="r-nav align-items-center ">
                      <a data-bs-toggle="modal" data-bs-target="#searchModal" class="img-s">
                          <i class="bi bi-search px-3 py-2 fs-5"></i>
                      </a>
                      <div class="login-tab mt-4 align-items-center" style="max-width: 200px;">
                          <hr class="d-none d-sm-block">
                      <a href="#"><img src="{{asset('nemolab/assets/image/avatar.png')}}" alt="" class="img-p mx-2"></a>
                        <p class="mx-2 my-auto">Halo, </p>
                        <p class="name my-auto">Burhan</p>
                      </div>
                      <div class="login align-items-center" style="max-width: 200px;">
                        <hr class="d-none d-sm-block">
                        <p class="mx-2 my-auto">Halo, </p>
                        <p class="name my-auto">Burhan</p>
                        <a href="#"><img src="{{asset('nemolab/assets/image/avatar.png')}}" alt="" class="img-p mx-2"></a>
                    </div>
                  </div>
              </div>
          </div>
      </nav>
      
      </div>
      <!-- SEARCH MODAL -->
      <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="searchModalLabel">Search</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label for="searchInput" class="form-label">Search</label>
                  <input type="text" class="form-control" id="searchInput" placeholder="Enter your search">
                </div>
                <button type="submit" class="btn-search px-2 py-1">Search</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>