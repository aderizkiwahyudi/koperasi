<x-app-layout>
    
    <main id="dashboard">
        
        <x-app-header-layout></x-app-header-layout>
        
        <div class="content">
            <div class="row">
                <div class="col col-item col-md-6">
                    <div class="item bg-white p-3 rounded border">
                        <div class="item-header d-flex justify-content-between align-items-center">
                            <div>
                                <small>Jumlah Pinjaman</small>
                                <p>Rp {{ number_format($loan->nominal, 0, '.', '.') }}</p>
                            </div>
                            <div>
                                <small>Tenor</small>
                                <p>{{ $loan->length_of_loan }} Bulan</p>
                            </div>
                        </div>
                        <div class="item-body p-3 border bg-light">
                            <div class="item-loans d-flex align-items-center justify-content-between">
                                <p>Pencairan</p>
                                <p>Rp {{ number_format($loan->nominal, 0, '.', '.') }}</p>
                            </div>
                            <div class="item-loans d-flex align-items-center justify-content-between">
                                <p>Bunga</p>
                                <p>{{ $loan->interest_rate }}%</p>
                            </div>
                            <div class="item-loans d-flex align-items-center justify-content-between">
                                <p>Cicilan Bulanan</p>
                                <p>{{ getInstalment($loan->nominal, $loan->length_of_loan, $loan->interest_rate) }}</p>
                            </div>
                            <div class="item-loans d-flex align-items-center justify-content-between">
                                <p>Status Pencairan</p>
                                <p>{!! getLoanStatus($loan->status) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-item col-md-6">

                    <x-alert></x-alert>

                    <div class="item bg-white p-3 rounded border">
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="item-body">
                                <h5 class="mb-0">Pembayaran</h5>
                                <div class="form-group mb-2">
                                    <label for="" class="label"><small>Nominal</small></label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="text" name="nominal" class="form-control" value="" placeholder="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label"><small>Bukti Pembayaran</small></label>
                                    <input type="file" name="file" id="file" class="form-control" required/>
                                </div>
                            </div>
                            <div class="item-footer mt-3">
                                <button type="submit" class="btn btn-main w-100">Bayar Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <x-app-footer-layout></x-app-footer-layout>

    </main>

    @push('script')
        <script src="{{ asset('js/rupiah.js') }}"></script>
        <script src="{{ asset('js/instelment.js') }}"></script>
        <script>
            $(document).ready(() => {
                $('input[name="nominal"]').on('keyup', function(){
                    let nominal = $(this).val();
                    return $(this).val(rupiah(nominal));
                });
            });
        </script>
    @endpush

</x-app-layout>