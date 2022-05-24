<x-app-layout>
    
    <main id="dashboard">
        
        <x-app-header-layout></x-app-header-layout>
        
        <div class="content">
            <div class="row">
                @foreach ($loan_recommendations as $item)
                    <div class="col col-item col-md-6">
                        <div class="item bg-white p-3 rounded border">
                            <div class="item-header d-flex justify-content-between align-items-center">
                                <div>
                                    <small>Jumlah Pinjaman</small>
                                    <p>Rp {{ number_format($item->nominal, 0, '.', '.') }}</p>
                                </div>
                                <div>
                                    <small>Tenor</small>
                                    <p>{{ $item->length_of_loan }} Bulan</p>
                                </div>
                            </div>
                            <div class="item-body p-3 border bg-light">
                                <div class="item-loans d-flex align-items-center justify-content-between">
                                    <p>Pencairan</p>
                                    <p>Rp {{ number_format($item->nominal, 0, '.', '.') }}</p>
                                </div>
                                <div class="item-loans d-flex align-items-center justify-content-between">
                                    <p>Bunga</p>
                                    <p>{{ $setting->interest_rate }}%</p>
                                </div>
                                <div class="item-loans d-flex align-items-center justify-content-between">
                                    <p>Cicilan Bulanan</p>
                                    <p>{{ getInstalment($item->nominal, $item->length_of_loan, $setting->interest_rate) }}</p>
                                </div>
                            </div>
                            <div class="item-footer mt-3">
                                <a href="{{ route('loan', ['id' => $item->id]) }}" class="btn btn-main w-100">Ajukan</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <x-app-footer-layout></x-app-footer-layout>

    </main>

</x-app-layout>