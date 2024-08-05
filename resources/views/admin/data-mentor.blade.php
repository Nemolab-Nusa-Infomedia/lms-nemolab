@extends('components.layouts.superadmin.dashboard')

@section('title, data-member')

@section('content-data-member')
<div class="container">
    <div class="container-fluid mt-5 mb-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 d-none d-md-block sidebar px-3 py-4">
                <div class="sidebar-sticky">
                    <h6 class="view-data mt-3">View Data</h6>
                    <a class="sidebar-a py-1 px-1 d-flex" href="superadmin-data-member.html">
                        <img src="assets/img/ic_invoice_gray 1(gray).png" class="sidebar-img active">
                        <p class="side-text mx-1 mb-0">Data Member</p>
                    </a>
                    <a class="sidebar-a py-1 px-1 d-flex aktif" href="superadmin-data-mentor.html">
                        <img src="assets/img/ic_invoice_gray 1(white).png" class="sidebar-img active">
                        <p class="side-text mx-1 mb-0">Data Mentor</p>
                    </a>
                    <a class="sidebar-a py-1 px-1 d-flex" href="superadmin-data-superadmin.html">
                        <img src="assets/img/ic_invoice_gray 1(gray).png" class="sidebar-img active">
                        <p class="side-text mx-1 mb-0">Data Superadmin</p>
                    </a>
                    <a class="sidebar-a py-1 px-1 d-flex" href="superadmin-data-pengajuan-mentor.html">
                        <img src="assets/img/ic_invoice_gray 2.png" class="sidebar-img active">
                        <p class="side-text mx-1 mb-0">Pengajuan Mentor</p>
                    </a>
                    <h6 class="learn mt-5">Learn</h6>
                    <a class="sidebar-a py-1 px-1 d-flex" href="superadmin-data-admin-courses.html">
                        <img src="assets/img/ic_invoice_gray 2(1).png" class="sidebar-img active">
                        <p class="side-text mx-1 mb-0">Courses</p>
                    </a>
                    <a class="sidebar-a py-1 px-1 d-flex" href="#">
                        <img src="assets/img/book.png" class="sidebar-img active">
                        <p class="side-text mx-1 mb-0">Lesson</p>
                    </a>
                    <a class="sidebar-a py-1 px-1 d-flex" href="#">
                        <img src="assets/img/ic_invoice_gray 3.png" class="sidebar-img active">
                        <p class="side-text mx-1 mb-0">Chapter</p>
                    </a>
                    <h6 class="category mt-5">Category</h6>
                    <a class="sidebar-a py-1 px-1 d-flex" href="#">
                        <img src="assets/img/ic_invoice_gray 3(1).png" class="sidebar-img active">
                        <p class="side-text mx-1 mb-0">Category</p>
                    </a>
                </div>
            </div>
            <!-- End Sidebar -->

            <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1">
                    <h1 class="judul-table">Data Mentor</h1>
                </div>
        
                <div class="table-responsive px-3 py-3">
                    <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 me-2 text-center">Show</p>
                            <select id="entries" class="form-select form-select-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <p class="mb-0 me-2 text-center mx-2">entries</p>
                        </div>
                        <button class="tambah-data px-2 py-2">Tambah</button>
                    </div>
                    
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Konfirm Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-between px-1 py-1">
                        <p class="show">Showing 10 of 10</p>
                        <div class="d-flex">
                            <button class="pagination mx-1" id="prev-button">Previous</button>
                            <button class="pagination mx-1" id="next-button">Next</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

@endsection