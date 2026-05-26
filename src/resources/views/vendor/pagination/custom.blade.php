@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $maxLinks = 5;

        $startPage = max($currentPage - 2, 1);
        $endPage = $startPage + $maxLinks - 1;

        if ($endPage > $lastPage) {
            $endPage = $lastPage;
            $startPage = max($endPage - $maxLinks + 1, 1);
        }
    @endphp

    <nav class="pagination" role="navigation">

        {{-- 前へ --}}
        @if ($paginator->onFirstPage())
            <span class="pagination__item pagination__item--disabled">&lt;</span>
        @else
            <a class="pagination__item" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
        @endif

        {{-- ページ番号 --}}
        @for ($page = $startPage; $page <= $endPage; $page++)
            @if ($page == $currentPage)
                <span class="pagination__item pagination__item--active">{{ $page }}</span>
            @else
                <a class="pagination__item" href="{{ $paginator->url($page) }}">{{ $page }}</a>
            @endif
        @endfor

        {{-- 次へ --}}
        @if ($paginator->hasMorePages())
            <a class="pagination__item" href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
        @else
            <span class="pagination__item pagination__item--disabled">&gt;</span>
        @endif

    </nav>
@endif