@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>
@endpush

@push('script')
    <script>
        $('.bars').on('click', () => {
            if($('aside').hasClass('hide')){
                $('aside').removeClass('hide');
                $('main').css('flex-wrap', 'nowrap');
            }else{
                $('aside').addClass('hide');
                $('main').css('flex-wrap', 'wrap');
            }
        });
    </script>
@endpush

<aside>
    <div class="header">
        <div class="title"><h1><a href="{{ route('admin.dashboard') }}">Administrator</a></h1></div>
    </div>
    <div class="nav">
        <ul>
            <li class="navigation-name">Dashboard</li>
            <li {{ Request::segment(2) == 'dashboard' ? "class=active" : '' }}><a href="{{ route('admin.dashboard') }}"><i class="bi bi-columns-gap"></i> Dashboard</a></li>
            <li {{ Request::segment(2) == 'karyawan' ? "class=active" : '' }}><a href="{{ route('admin.employee') }}"><i class="bi bi-people"></i> Karyawan</a></li>
            <li {{ Request::segment(2) == 'pengajuan-pinjaman' ? "class=active" : '' }}><a href="{{ route('admin.loan') }}"><i class="bi bi-front"></i> Pengajuan Pinjaman</a></li>
            <li class="navigation-name">Lainnya</li>
            <li {{ Request::segment(2) == 'rekomendasi-pinjaman' ? "class=active" : '' }}><a href="{{ route('admin.recommendation') }}"><i class="bi bi-three-dots"></i> Rekomendasi Pinjaman</a></li>
            <li {{ Request::segment(2) == 'pengaturan-pinjaman' ? "class=active" : '' }}><a href="{{ route('admin.loan_setting') }}"><i class="bi bi-gear"></i> Pengaturan Pinjaman</a></li>
            <li class="navigation-name">Akun</li>
            <li {{ Request::segment(2) == 'pengaturan' ? "class=active" : '' }}><a href="{{ route('admin.setting_account') }}"><i class="bi bi-gear"></i> Pengaturan</a></li>
            <li><a href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-right"></i> Keluar</a></li>
        </ul>
    </div>
</aside>