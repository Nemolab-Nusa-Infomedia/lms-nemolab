<div class="d-flex justify-content-center">
    <div class="card d-flex flex-column">
        @if ($ebook->cover != null)
        <img src="{{ asset('storage/images/covers/' . $ebook->cover) }}" class="card-img-top d-block" alt="{{ $ebook->name }}" />
        @else
            <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top d-block" alt="{{ $ebook->name }}" />
        @endif
        {{-- <div class="card-head d-block d-md-none">
            @if ($ebook->cover != null)
            <img src="{{ asset('storage/images/covers/' . $ebook->cover) }}" class="card-img-top" alt="{{ $ebook->name }}" />
            @else
                <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top" alt="{{ $ebook->name }}" />
            @endif
            <div class="harga mt-4">
                <p class="p-0 m-0 fw-bold">Harga</p>
                <p class="p-0 m-0 fw-bold">{{ $ebook->price == 0 ? 'Gratis' : 'Rp' . number_format($ebook->price, 0, ',', '.') }}</p>
            </div>
        </div> --}}
        <div class="card-body">
            <div class="paket d-flex">
                <p class="paket-item mt-md-2">E-book</p>
            </div>
            <div class="title-card">
                <a href="{{ route('member.course.join', $ebook->slug) }}">
                    <p>{{ $ebook->category }}</p>
                    <h5 class="fw-bold truncate-text">{{ $ebook->name }}</h5>
                </a>
                <p class="avatar m-0 fw-bold me-1">
                    @if ($ebook->users->avatar != null)
                    <img class="me-2" src="{{ asset('storage/images/avatars/' . $ebook->users->avatar) }}" alt="" />
                    @else
                    <img class="me-2" src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" alt="" />
                    @endif
                    {{ $ebook->users->name }}
                </p>
            </div>
            <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3">
                <div class="harga d-block">
                    <p class="p-0 m-0 fw-semibold">Harga</p>
                    <p class="p-0 m-0 fw-semibold">{{ $ebook->price == 0 ? 'Gratis' : 'Rp' . number_format($ebook->price, 0, ',', '.') }}</p>
                </div>
                <a href="{{ route('member.ebook.join', $ebook->slug) }}" class="btn btn-primary">Mulai Belajar</a>
            </div>
        </div>
    </div>
</div>
