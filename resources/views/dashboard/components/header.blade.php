<header>
    <div class="header">
        <h1><a href="/"><strong>KOPERASI</strong> PT. UNGARAN SARI GARMENT</a></h1>
        <div class="logout">
            <a href="{{ route('logout') }}" class="btn btn-danger d-desktop">Logout</a>
            <a href="javascript:void(0)" class="bars d-mobile text-white"><i class="bi bi-list"></i></a>
        </div>
    </div>
    <div class="navigation">
        <ul class="nav">
            <li {{ Request::segment(1) == 'dashboard' ? "class=active" : '' }}>
                <a href="{{ route('dashboard') }}"><i class="bi bi-house-fill"></i></a>
            </li>
            <li {{ Request::segment(1) == 'pengajuan-pinjaman' ? "class=active" : '' }}>
                <a href="{{ route('loan') }}">PENGAJUAN PIMJAMAN</a>
            </li>
            <li {{ Request::segment(1) == 'riwayat-pinjaman' ? "class=active" : '' }}>
                <a href="{{ route('loan_history') }}">RIWAYAT PIMJAMAN</a>
            </li>
            <li {{ Request::segment(1) == 'pengaturan' ? "class=active" : '' }}>
                <a href="{{ route('setting') }}">PENGATURAN</a>
            </li>
            <li class="d-mobile">
                <a href="{{ route('logout') }}">LOGOUT</a>
            </li>
        </ul>
    </div>
</header>

<div class="breadcrumb-container">
    <h4>{{ strtoupper(str_replace('-',' ',Request::segment(1))) }}</h4>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{ route('dashboard') }}">Home</a>
        @foreach (Request::segments() as $item)
            <span class="breadcrumb-item" href="{{ route('dashboard') }}">{{ ucwords(str_replace('-',' ',$item)) }}</span>
        @endforeach
    </nav>
</div>

@push('script')
    <script>
        $('.bars').on('click', () => {
            if($('.navigation').css('display') == 'none'){
                return $('.navigation').show();
            }else{
                return $('.navigation').hide();
            }
        });
    </script>
@endpush