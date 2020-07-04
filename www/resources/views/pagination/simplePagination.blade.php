<div id="navigation-buttons">
    @if ($paginator->onFirstPage())
        <a href="#">Indietro</a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}">Indietro</a>
    @endif

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" >Avanti</a>
    @else
    <a href="#">Avanti</a>
    @endif
</div>