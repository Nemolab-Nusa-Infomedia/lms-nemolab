<!-- Sidebar -->
<div class="col-md-3 p-0 scroll-parent">
    <div class="col-md-9 ms-5">
        <div class="sidebar">
            <div class="filter sort">
                <div class="filter-header text-start">
                    <h5 class="d-inline">Sort</h5>
                </div>
                <ul>
                    <li>
                        <input type="radio" id="sort-new" name="sort" data-sort="new" checked>
                        <label for="sort-new"><span></span>Baru Rilis</label>
                    </li>
                    <li>
                        <input type="radio" id="sort-popular" name="sort" data-sort="popular">
                        <label for="sort-popular"><span></span>Terpopuler</label>
                    </li>
                    <li>
                        <input type="radio" id="sort-price-low" name="sort" data-sort="price_low">
                        <label for="sort-price-low"><span></span>Harga Terendah</label>
                    </li>
                    <li>
                        <input type="radio" id="sort-price-high" name="sort" data-sort="price_high">
                        <label for="sort-price-high"><span></span>Harga Tertinggi</label>
                    </li>
                </ul>
            </div>
            
            <div class="filter level">
                <div class="filter-header text-start">
                    <h5 class="d-inline">Level</h5>
                </div>
                <ul>
                    <li>
                        <input type="radio" id="level-beginner" name="level" data-level="beginner">
                        <label for="level-beginner"><span></span>Beginner Friendly</label>
                    </li>
                    <li>
                        <input type="radio" id="level-intermediate" name="level" data-level="intermediate">
                        <label for="level-intermediate"><span></span>Intermediate</label>
                    </li>
                    <li>
                        <input type="radio" id="level-expert" name="level" data-level="expert">
                        <label for="level-expert"><span></span>Expert</label>
                    </li>
                    <li>
                        <input type="radio" id="level-all" name="level" data-level="all" checked>
                        <label for="level-all"><span></span>All Level</label>
                    </li>
                </ul>             
            </div>

            <div class="filter type">
                <div class="filter-header text-start">
                    <h5 class="d-inline">Type</h5>
                </div>
                <ul>
                    <li>
                        <input type="radio" id="type-starter" name="type" data-type="starter">
                        <label for="type-starter"><span></span>Starter (Rp.0)</label>
                    </li>
                    <li>
                        <input type="radio" id="type-premium" name="type" data-type="premium">
                        <label for="type-premium"><span></span>Premium</label>
                    </li>
                    <li>
                        <input type="radio" id="type-all" name="type" data-type="all" checked>
                        <label for="type-all"><span></span>All Type</label>
                    </li>
                </ul>
            </div>

            <div class="filter tahun">
                <div class="filter-header text-start">
                    <h5 class="d-inline">Tahun</h5>
                </div>
                <ul>
                    @foreach($yearOptions as $year)
                    <li>
                        <input type="radio" id="year-{{ $year }}" name="year" data-year="{{ $year }}" {{ $year == $currentYear ? 'checked' : '' }}>
                        <label for="year-{{ $year }}"><span></span>{{ $year }}</label>
                    </li>
                    @endforeach
                </ul>     
            </div>
        </div>
    </div>
</div>