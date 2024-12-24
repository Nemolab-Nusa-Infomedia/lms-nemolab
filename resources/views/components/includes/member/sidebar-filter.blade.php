<!-- Sidebar -->
<div class="col-md-3 p-0">
    <div class="col-md-9 ms-5">
        <div class="sidebar">
            <div class="filter-paket">
                <div class="filter-header text-center">
                    <img src="{{ asset('nemolab/components/member/img/ph_book-fill.png') }}" class="filter-logo" alt="...">
                    <h5 class="fw-bold d-inline">Filter Paket</h5>
                </div>
                <hr>
                <form action="{{ route('member.course') }}" method="GET">
                    <ul>
                        <li>
                            <input id="filter-paket-semua" name="filter-paket" checked="checked" value="semua" type="radio" onchange="this.form.submit()" {{ request('filter-paket') == 'semua' ? 'checked' : '' }}>
                            <label for="filter-paket-semua">
                                <span></span>
                                Semua
                            </label>
                        </li>
                        <li>
                            <input id="filter-paket-kursus" name="filter-paket" value="paket-kursus" type="radio" onchange="this.form.submit()" {{ request('filter-paket') == 'paket-kursus' ? 'checked' : '' }}>
                            <label for="filter-paket-kursus">
                                <span></span>
                                Kursus
                            </label>
                        </li>
                        <li>
                            <input id="filter-paket-ebook" name="filter-paket" value="paket-ebook" type="radio" onchange="this.form.submit()" {{ request('filter-paket') == 'paket-ebook' ? 'checked' : '' }}>
                            <label for="filter-paket-ebook">
                                <span></span>
                                E-book
                            </label>
                        </li>
                        <li>
                            <input id="filter-paket-bundling" name="filter-paket" value="paket-bundling" type="radio" onchange="this.form.submit()" {{ request('filter-paket') == 'paket-bundling' ? 'checked' : '' }}>
                            <label for="filter-paket-bundling">
                                <span></span>
                                Paket Combo
                            </label>
                        </li>
                    </ul>
            </div>
            
            <div class="filter-kelas">
                <div class="filter-header text-center">
                    <img src="{{ asset('nemolab/components/member/img/hugeicons_nano-technology.png') }}" class="filter-logo" alt="...">
                    <h5 class="fw-bold d-inline">Filter Kelas</h5>
                </div>
                <hr>
                    <ul>
                        <li>
                            <input id="filter-kelas-semua" name="filter-kelas" value="semua" checked="checked" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'semua' ? 'checked' : '' }}>
                            <label for="filter-kelas-semua">
                                <span></span>
                                Semua
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-uiux" name="filter-kelas" value="UI/UX Designer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'UI/UX Designer' ? 'checked' : '' }}>
                            <label for="filter-kelas-uiux">
                                <span></span>
                                UI/UX Designer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-frontend" name="filter-kelas" value="Frontend Developer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Frontend Developer' ? 'checked' : '' }}>
                            <label for="filter-kelas-frontend">
                                <span></span>
                                Frontend Developer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-backend" name="filter-kelas" value="Backend Developer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Backend Developer' ? 'checked' : '' }}>
                            <label for="filter-kelas-backend">
                                <span></span>
                                Backend Developer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-wordpress" name="filter-kelas" value="Wordpress Developer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Wordpress Developer' ? 'checked' : '' }}>
                            <label for="filter-kelas-wordpress">
                                <span></span>
                                Wordpress Developer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-graphics" name="filter-kelas" value="Graphics Designer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Graphics Designer' ? 'checked' : '' }}>
                            <label for="filter-kelas-graphics">
                                <span></span>
                                Graphics Designer
                            </label>
                        </li>
                        <li>
                            <input id="filter-kelas-fullstack" name="filter-kelas" value="Fullstack Developer" type="radio" onchange="this.form.submit()" {{ request('filter-kelas') == 'Fullstack Developer' ? 'checked' : '' }}>
                            <label for="filter-kelas-fullstack">
                                <span></span>
                                Fullstack Developer
                            </label>
                        </li>
                    </ul>
                </form>
                
            </div>
        </div>
    </div>
</div>