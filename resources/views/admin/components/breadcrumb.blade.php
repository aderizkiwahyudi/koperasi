<div class="breadcrumb-container">
    <h4>{{ ucwords(str_replace('-', ' ', Request::segment(2))) }}</h4>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="#">Home</a>
        @foreach (Request::segments() as $key => $item)
            @if ($key > 0)
                <span class="breadcrumb-item {{ $key == count(Request::segments())-1 ? 'active' : '' }}">{{ ucwords(str_replace('-', ' ', $item)) }}</span>
            @endif
        @endforeach
    </nav>
</div>