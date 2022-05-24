<x-app-layout>
    
    <main id="dashboard">
        
        <x-app-header-layout></x-app-header-layout>
        
        <div class="content">
            <div class="row">
                <div class="col col-item col-md-6">

                    <x-alert></x-alert>

                    <div class="item bg-white p-3 rounded border">
                        <form method="post">
                            @csrf
                            <div class="item-header">
                                <h5>FORMULIR PENGAJUAN</h5>
                            </div>
                            <div class="item-body">
                                <div class="form-group mb-2">
                                    <label for="" class="label"><small>Jumlah Pinjaman</small></label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="text" name="nominal" class="form-control" value="{{ $loan_recommendation ? number_format($loan_recommendation->nominal, 0, '.', '.') : '' }}" placeholder="0"/>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="" class="label"><small>Tenor</small></label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" name="length_of_loan" class="form-control" value="{{ $loan_recommendation->length_of_loan ?? '' }}" placeholder="Masukan tenor pinjaman"/>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Bulan</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="label"><small>Bunga</small></label>
                                            <input type="text" name="interest_rate" class="form-control" value="{{ $setting->interest_rate ?? 0 }}%" disabled/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="label"><small>Cicilan Perbulan</small></label>
                                            <div class="input-group mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="text" class="form-control instelment" value="{{ $loan_recommendation ? getInstalment($loan_recommendation->nominal, $loan_recommendation->length_of_loan, $setting->interest_rate) : '' }}" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-footer mt-3">
                                <button type="submit" class="btn btn-main w-100">Ajukan</button>
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

                $('input[name="length_of_loan"]').on('keyup', function(){
                    let nominal = $('input[name="nominal"]').val();
                    let interest_rate = $('input[name="interest_rate"]').val();
                    let length_of_loan = $(this).val();

                    return $(".instelment").val(getInstelment(nominal, length_of_loan, interest_rate));
                })
            });
        </script>
    @endpush

</x-app-layout>