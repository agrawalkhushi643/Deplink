@if($paginator->hasPages())
    {{-- Previous Page Link --}}
    @if($paginator->onFirstPage())
        &lsaquo;
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if(is_string($element))
            {{ $element }}
        @endif

        {{-- Array Of Links --}}
        @if(is_array($element))
            @foreach($element as $page => $url)
                @if($page == $paginator->currentPage())
                    <b>{{ $page }}</b>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
    @else
        &rsaquo;
    @endif
@endif
