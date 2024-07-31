@extends('components.layouts.member.course')

@section('title, nemolab')

@section('content-course')
    <!-- CONTENT -->
    <div class="container-sm mt-3">
        <div class="container mt-5">
            <div class="alert alert-warning alert-dismissible fade show text-black" role="alert">
              Ingin jadi Mentor? klik <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="disini text-decoratiom-none text-black px-2 py-1">   Disini</a>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        
          <!-- alert -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Apakah Anda yakin ingin menjadi mentor?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                  <button type="button" class="btn-alert">Yes</button>
                </div>
              </div>
            </div>
          </div>
        
    <div class="container-sm" style="height: 700px;">
        <div class="content2 row top justify-content-between mx-auto" style="width: 95%;">
            <div class="dropdown">
                <a class="dropdown-toggle text-black fs-5" href="#"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Category
                </a>
              
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">ALL</a></li>
                  <li><a class="dropdown-item" href="#">Design Grafis</a></li>
                  <li><a class="dropdown-item" href="#">UI/UX Design</a></li>
                  <li><a class="dropdown-item" href="#">Designer Web</a></li>
                  <li><a class="dropdown-item" href="#">Soft Skills</a></li>
                </ul>
              </div>
            
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="card-category d-flex flex-column full-width-border">
                    <p class="mx-auto text-center pt-2 pb-1 border-bottom mt-3 mb-4">Category</p>
                    <div class="checkbox ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                ALL
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Design Grafis
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                UI/UX Design
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Pemrograman Web
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Soft Skills
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9 col-md-7 col-sm-12 row d-flex mx-auto" style="height: auto;">
                <div class="scroll row mx-auto pt-1 pb-1">
                    <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mb-lg-4 m-mobile first-card">
                        <a href="user_course.html" class="text-decoratiom-none" onclick="navigateToPage(event, 'user_course.html')">
                            <div class="card-course">
                                <img src="{{asset('nemolab/assets/image/burhan1.png')}}" class="img-card" alt="">
                                <div class="container-card px-3 mt-2">
                                    <p class="produck-title text-black" style="margin-top: -10px;">Design Grafis : Belajar Basic</p>
                                    <div class="profile-card d-flex mt-lg-3 mt-sm-0">
                                        <a href="" class="img-a my-auto"><img src="{{asset('nemolab/assets/image/avatar.png')}}" alt="" class="card-img-profile"></a>
                                        <a href="" class="kurung text-a text-decoration-none">
                                            <p class="profile-mentor text-black my-2">Burhan sssssssssssssssssjualan </p>
                                        </a>
                                    </div>
                                    <div class="price mt-1">
                                      <p class="text-black mb-0 fw-lighter">Rp. 500,000</p>
                                    </div>
                                    <div class="status d-flex">
                                      <div class="left d-flex">
                                          <img src="{{asset('nemolab/assets/image/Lesson.png')}}" alt="">
                                          <p class="text-black mb-0 ms-1">4 Lesson</p>
                                          <img src="{{asset('nemolab/assets/image/Hours.png')}}" style="height: 20px; margin-top: -1px; margin-left: 10px;" alt="">
                                          <p class="text-black mb-0 ms-1">4 Hours</p>
                                      </div>
                                      <div class="right d-flex">
                                          <img src="{{asset('nemolab/assets/image/star.png')}}" style="height: 20px; margin-top: -1px;" alt="">
                                          <p class="text-black mb-0 ms-1">4.5</p>
                                      </div>
                                  </div>
                                  
                                </div>
                            </div>
                        </a>
                    </div>
                    
                  </div>
              </div>
          </a>
      </div>
    
                </div>
              </div>
            </div>
@endsection