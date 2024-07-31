@extends('components.layouts.member.joinclass')

@section('title, nemolab')

@section('back', 'My Course')

@section('contentclassvideo')

<div class="container mb-5" id="content">
    <div class="row mt-4">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card costum-card">
                <p class="text-center fs-5 text-white fw-bold pt-2 border-bottom">Materi</p>
                <div class="d-grid gap-2 px-3">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item mt-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                    Awal
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <button
                                        class="btn btn-primary btn-video mx-auto mt-3 d-flex justify-content-between"
                                        type="button" onclick="location.href='./user_video.html';">
                                        <div class="d-flex play">
                                            <img src="{{asset('nemolab\assets\image\play.png')}}" alt="">
                                            <p class="ms-2 my-auto opacity-75">Trailer</p>
                                        </div>
                                        <div class="bg-white rounded-circle check"></div>
                                    </button>
                                    <button
                                        class="btn btn-primary btn-video mx-auto mt-3 d-flex justify-content-between"
                                        type="button" onclick="location.href='./user_video.html';">
                                        <div class="d-flex play">
                                            <img src="{{asset('nemolab\assets\image\play.png')}}" alt="">
                                            <p class="ms-2 my-auto opacity-75">Trailer</p>
                                        </div>
                                        <div class="bg-white rounded-circle check"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item mt-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Properties
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <button
                                        class="btn btn-primary btn-video mx-auto mt-3 d-flex justify-content-between"
                                        type="button" onclick="location.href='./user_video.html';"
                                        aria-expanded="false">
                                        <div class="d-flex play">
                                            <img src="{{asset('nemolab\assets\image\play.png')}}" alt="">
                                            <p class="ms-2 my-auto opacity-75">Trailer</p>
                                        </div>
                                        <div class="bg-white rounded-circle check"></div>
                                    </button>
                                    <button
                                        class="btn btn-primary btn-video mx-auto mt-3 d-flex justify-content-between"
                                        type="button" onclick="location.href='./user_video.html';">
                                        <div class="d-flex play">
                                            <img src="{{asset('nemolab\assets\image\play.png')}}" alt="">
                                            <p class="ms-2 my-auto opacity-75">Trailer</p>
                                        </div>
                                        <div class="bg-white rounded-circle check"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12">
            <iframe width="100%" height="490px" src="https://www.youtube.com/embed/QFLAuddS6qM?si=SNXH5ZxgHVhXTIjX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12"></div>
        <div class="about col-lg-9 col-md-9 col-sm-12 d-flex mt-3">
            <div class="wrapper">
                <div class="title-deskripsi">
                    <h4>Design Navbar Section</h4>
                    <p>Materi bagian: Project Navigation</p>
                </div>
                <div class="profile-mentor d-flex">
                    <img src="{{asset('nemolab/assets/image/profile2.png')}}" alt="">
                    <p class="ms-2">Radiansyah</p>
                </div>
                <div class="resource">
                    <h4 class="fw-bold mt-3">Resource</h4>
                    <div class="d-flex course-option mt-3">
                        <a href="download" class="btn btn-download d-flex align-item-center">
                            <img src="{{asset('nemolab/assets/image/download.png')}}" alt="">
                            <div class="text-download ms-3">
                                <p class="my-auto text-left" style="width:70%;">Download</p>
                                <p class="my-auto">Assets Belajar</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-play mb-3 ms-auto">Complete</button>
        </div>
        
    </div>
</div>
@endsection