@if ($paginator->hasPages())
<div class="shop-pagination">
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li><a href="#" rel="prev"><button class="pink no-round-btn smooth"><i class="fas fa-arrow-left"></i></button></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><button class="no-round-btn smooth"><i class="fas fa-arrow-left"></i></button></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><button class="pink no-round-btn smooth disabled">{{ $element }}</button></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><button class="pink no-round-btn smooth active">{{ $page }}</button></li>
                    @else
                        <li><a href="{{ $url }}"><button class="pink no-round-btn smooth">{{ $page }}</button></a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><button class="pink no-round-btn smooth"><i class="fas fa-arrow-right"></i></button></a></li>
        @else
            <li><a href="#"><button class="pink no-round-btn smooth"><i class="fas fa-arrow-right"></i></button></a></li>
        @endif
    </ul>
</div>
@endif
