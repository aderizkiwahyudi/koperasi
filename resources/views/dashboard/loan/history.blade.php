<x-app-layout>
    
    <main id="dashboard">
        
        <x-app-header-layout></x-app-header-layout>
        
        <div class="content">
            <div class="row">
                @forelse ($loans as $item)
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
                                    <p>{{ $item->interest_rate }}%</p>
                                </div>
                                <div class="item-loans d-flex align-items-center justify-content-between">
                                    <p>Cicilan Bulanan</p>
                                    <p>{{ getInstalment($item->nominal, $item->length_of_loan, $item->interest_rate) }}</p>
                                </div>
                                <div class="item-loans d-flex align-items-center justify-content-between">
                                    <p>Status Pencairan</p>
                                    <p>{!! getLoanStatus($item->status) !!}</p>
                                </div>
                            </div>
                            <div class="item-footer mt-3">
                                <a href="{{ route('loan_history.detail', $item->id) }}" class="btn btn-main w-100">Cek</a>
                            </div>
                        </div>
                    </div>
                    @if (Request::segment(2))
                        <div class="col-md-6">
                            <h5 class="mb-0">Pembayaran</h5>
                            <small>Cek Status Pembayaran Terbaru</small>
                            @forelse ($item->Installments as $installment)
                                <div class="item bg-white p-3 rounded border mt-3">
                                    <div class="item-header d-flex justify-content-between align-items-center">
                                        <div>
                                            <small>Jumlah Pembayaran</small>
                                            <p>Rp {{ number_format($installment->nominal + $installment->penalties, 0, '.', '.') }}</p>
                                        </div>
                                        <div>
                                            <small>Tanggal</small>
                                            <p>{{ date('d/m/Y', strtotime($installment->created_at)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            <div class="py-3">
                                <p>Data pembayaran tidak ada</p>
                            </div>
                            @endforelse
                        </div>
                    @endif
                    @empty
                        <div class="col-md-12">
                            Tidak ada riwayat peminjaman
                        </div>
                    @endforelse
            </div>
        </div>

        <x-app-footer-layout></x-app-footer-layout>

    </main>

</x-app-layout>