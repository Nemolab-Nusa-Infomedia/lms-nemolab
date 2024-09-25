@extends('components.layouts.member.navback')

@section('title', 'Forum Diskusi')

@section('content')
    @push('prepend-style')
        <link rel="stylesheet" href="{{ asset('nemolab/member/css/diskusi.css') }}">
    @endpush
    <div class="container">
        <h3 class="text-center text-black fw-semibold" style="margin-top: 5rem; color:#faa907 !important">Forum Diskusi</h3>
        <h2 class="text-center text-black">{{ $forum->tittle }}</h2>
        <div class="box mx-auto mt-5">
            <form action="{{ route('member.forum.search', ['slug' => $course->slug]) }}" method="GET">
                <button type="submit" class="cari-btn">
                    <img src="{{ asset('nemolab/member/img/search-diskusi.png') }}" alt="">
                </button>
                <input type="text" name="query" placeholder="Cari Pertanyaan Serupa" required>
                <input type="hidden" name="forum_id" value="{{ $forum->id }}">
            </form>
        </div>

        <div class="diskusi d-flex flex-column" style="margin-top: 5rem">
            <form action="{{ route('member.forum.comment.store', ['slug' => $course->slug]) }}" method="POST">
                @csrf
                <div class="input-comment mx-auto mb-5">
                    <div class="form-floating mx-auto">
                        <textarea name="comment" class="form-control" placeholder="Your Comment" id="floatingTextarea"
                            style="height: 100px; resize: none"></textarea>
                        <label class="fw-light ms-2 text-black" for="floatingTextarea">Berikan pertanyaan</label>
                    </div>
                    <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                    <button type="submit" class="btn-kirim mt-3 fw-semibold text-white rounded-3 float-end"
                        style="border: none">Kirim</button>
                </div>
            </form>
            <div id="commentsContainer">
                @include('member.comments', ['comments' => $comments])
            </div>
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="container mt-4">
        @if ($comments->hasPages())
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{-- Previous Page --}}
                    @if ($comments->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-disabled="true">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $comments->previousPageUrl() }}" rel="prev">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Current Page --}}
                    <li class="page-item">
                        <span class="page-link current-page">
                            {{ $comments->currentPage() }}
                        </span>
                    </li>

                    {{-- Next Page --}}
                    @if ($comments->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $comments->nextPageUrl() }}" rel="next">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link" aria-disabled="true">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var activePollingIds = {};
            var lastScrollTop = 0;
            // Fungsi untuk memulai polling
            function startPolling(commentId) {
                if (activePollingIds[commentId]) {
                    return;
                }
                stopPolling(commentId); // hentikan polling
                activePollingIds[commentId] = setInterval(function() {
                    var url = '{{ route('member.forum.replies', ['comment_id' => '__COMMENT_ID__']) }}'
                        .replace('__COMMENT_ID__', commentId);
                    // Menyimpan posisi scroll sebelum update
                    lastScrollTop = $(window).scrollTop();
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            if (typeof response === 'string') {
                                $('#collapsecomment' + commentId + ' .card-body').html(
                                response);
                                $(window).scrollTop(lastScrollTop);
                            } else {
                                console.error(
                                    `Format respons tidak valid untuk komentar ID: ${commentId}`
                                    );
                            }
                        },
                        error: function(xhr) {
                            console.error(
                                `Kesalahan saat memuat balasan untuk komentar ID: ${commentId}`,
                                xhr);
                        }
                    });
                }, 15000);
            }
            // Fungsi untuk menghentikan polling
            function stopPolling(commentId) {
                if (activePollingIds[commentId]) {
                    clearInterval(activePollingIds[commentId]);
                    delete activePollingIds[commentId];
                }
            }
            // Event handler untuk mengirim balasan
            $('.btn-send-reply').on('click', function() {
                var commentId = $(this).data('comment-id');
                var reply = $(this).siblings('.reply-input').val();

                $.ajax({
                    url: '{{ route('member.forum.reply.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        reply: reply,
                        comment_id: commentId
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Balasan berhasil dikirim',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#collapsecomment' + commentId + ' .card-body').load(
                                    '{{ route('member.forum.replies', ['comment_id' => '__COMMENT_ID__']) }}'
                                    .replace('__COMMENT_ID__', commentId));
                                stopPolling(commentId);
                                startPolling(commentId);
                                $('.reply-input').val('');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan',
                                text: 'Balasan gagal dikirim.',
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error('Kesalahan saat mengirim balasan:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: 'Terjadi kesalahan saat mengirim balasan.',
                        });
                    }
                });
            });
            // Event handler untuk membuka dan menutup collapse
            $('.collapse').on('show.bs.collapse', function() {
                var commentId = $(this).attr('id').replace('collapsecomment', '');
                startPolling(commentId); // Mulai polling saat collapse dibuka
            });
            $('.collapse').on('hide.bs.collapse', function() {
                var commentId = $(this).attr('id').replace('collapsecomment', '');
                stopPolling(commentId); // Hentikan polling saat collapse ditutup
            });
            // Fungsi untuk toggle chevron
            window.toggleChevron = function(chevronId) {
                var chevron = document.getElementById(chevronId);
                if (chevron.src.includes('chevron-down-orange.png')) {
                    chevron.src = '{{ asset('nemolab/member/img/chevron-up-orange.png') }}';
                } else {
                    chevron.src = '{{ asset('nemolab/member/img/chevron-down-orange.png') }}';
                }
            };
        });
    </script>
@endpush
