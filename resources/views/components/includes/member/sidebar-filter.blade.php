<!-- Sidebar -->
<div class="col-md-3 p-0 scroll-parent">
    <div class="col-md-9 ms-5">
        <div class="sidebar">
            <div class="filter sort">
                <div class="filter-header text-start">
                    <h5 class="d-inline">Sort</h5>
                </div>
                <form action="{{ route('member.course') }}" method="GET">
                    <ul>
                        <li>
                            <input id="sort-baru-rilis" name="sort" value="baru-rilis" type="radio" onchange="this.form.submit()" {{ request('sort') == 'baru-rilis' ? 'checked' : '' }}>
                            <label for="sort-baru-rilis">
                                <span></span>
                                Baru Rilis
                            </label>
                        </li>
                        <li>
                            <input id="sort-terpopuler" name="sort" value="sort-terpopuler" type="radio" onchange="this.form.submit()" {{ request('sort') == 'sort-terpopuler' ? 'checked' : '' }}>
                            <label for="sort-terpopuler">
                                <span></span>
                                Terpopuler
                            </label>
                        </li>
                        <li>
                            <input id="sort-sedang-promo" name="sort" value="sort-sedang-promo" type="radio" onchange="this.form.submit()" {{ request('sort') == 'sort-sedang-promo' ? 'checked' : '' }}>
                            <label for="sort-sedang-promo">
                                <span></span>
                                Sedang Promo
                            </label>
                        </li>
                        <li>
                            <input id="sort-herga-terendah" name="sort" value="sort-herga-terendah" type="radio" onchange="this.form.submit()" {{ request('sort') == 'sort-herga-terendah' ? 'checked' : '' }}>
                            <label for="sort-herga-terendah">
                                <span></span>
                                Harga Terendah
                            </label>
                        </li>
                        <li>
                            <input id="sort-herga-tertinggi" name="sort" value="sort-herga-tertinggi" type="radio" onchange="this.form.submit()" {{ request('sort') == 'sort-herga-tertinggi' ? 'checked' : '' }}>
                            <label for="sort-herga-tertinggi">
                                <span></span>
                                Harga Tertinggi
                            </label>
                        </li>
                    </ul>
            </div>
            
            <div class="filter level">
                <div class="filter-header text-start">
                    <h5 class="d-inline">Level</h5>
                </div>
                    <ul>
                        <li>
                            <input id="level-beginner" name="level" value="beginner" type="radio" onchange="this.form.submit()" {{ request('level') == 'beginner' ? 'checked' : '' }}>
                            <label for="level-beginner">
                                <span></span>
                                Beginner Friendly
                            </label>
                        </li>
                        <li>
                            <input id="level-intermediate" name="level" value="intermediate" type="radio" onchange="this.form.submit()" {{ request('level') == 'intermediate' ? 'checked' : '' }}>
                            <label for="level-intermediate">
                                <span></span>
                                Intermediate
                            </label>
                        </li>
                        <li>
                            <input id="level-all-level" name="level" value="all-level" type="radio" onchange="this.form.submit()" {{ request('level') == 'all-level' ? 'checked' : '' }}>
                            <label for="level-all-level">
                                <span></span>
                                All Level
                            </label>
                        </li>
                    </ul>             
               </div>

            <div class="filter type">
                <div class="filter-header text-start">
                    <h5 class="d-inline">Type</h5>
                </div>
                    <ul>
                        <li>
                            <input id="type-starter" name="type" value="starter" type="radio" onchange="this.form.submit()" {{ request('type') == 'starter' ? 'checked' : '' }}>
                            <label for="type-starter">
                                <span></span>
                                Starter (Rp.0)
                            </label>
                        </li>
                        <li>
                            <input id="type-premium" name="type" value="premium" type="radio" onchange="this.form.submit()" {{ request('type') == 'premium' ? 'checked' : '' }}>
                            <label for="type-premium">
                                <span></span>
                                Premium
                            </label>
                        </li>
                        <li>
                            <input id="type-all-type" name="type" value="all-type" type="radio" onchange="this.form.submit()" {{ request('type') == 'all-type' ? 'checked' : '' }}>
                            <label for="type-all-type">
                                <span></span>
                                All Type
                            </label>
                        </li>
                    </ul>            
                </div>

            <div class="filter tahun">
                <div class="filter-header text-start">
                    <h5 class="d-inline">Tahun</h5>
                </div>
                    <ul>
                        <li>
                            <input id="tahun-2019" name="tahun" value="2019" type="radio" onchange="this.form.submit()" {{ request('tahun') == '2019' ? 'checked' : '' }}>
                            <label for="tahun-2019">
                                <span></span>
                                2019
                            </label>
                        </li>
                        <li>
                            <input id="tahun-2020" name="tahun" value="2020" type="radio" onchange="this.form.submit()" {{ request('tahun') == '2020' ? 'checked' : '' }}>
                            <label for="tahun-2020">
                                <span></span>
                                2020
                            </label>
                        </li>
                        <li>
                            <input id="tahun-2021" name="tahun" value="2021" type="radio" onchange="this.form.submit()" {{ request('tahun') == '2021' ? 'checked' : '' }}>
                            <label for="tahun-2021">
                                <span></span>
                                2021
                            </label>
                        </li>
                        <li>
                            <input id="tahun-2022" name="tahun" value="2022" type="radio" onchange="this.form.submit()" {{ request('tahun') == '2022' ? 'checked' : '' }}>
                            <label for="tahun-2022">
                                <span></span>
                                2022
                            </label>
                        </li>
                        <li>
                            <input id="tahun-2023" name="tahun" value="2023" type="radio" onchange="this.form.submit()" {{ request('tahun') == '2023' ? 'checked' : '' }}>
                            <label for="tahun-2023">
                                <span></span>
                                2023
                            </label>
                        </li>
                        <li>
                            <input id="tahun-2024" name="tahun" value="2024" type="radio" onchange="this.form.submit()" {{ request('tahun') == '2024' ? 'checked' : '' }}>
                            <label for="tahun-2024">
                                <span></span>
                                2024
                            </label>
                        </li>
                        <li>
                            <input id="tahun-2025" name="tahun" value="2025" type="radio" onchange="this.form.submit()" {{ request('tahun') == '2025' ? 'checked' : '' }}>
                            <label for="tahun-2025">
                                <span></span>
                                2025
                            </label>
                        </li>
                    </ul>
                </form>             
            </div>
        </div>
    </div>
</div>