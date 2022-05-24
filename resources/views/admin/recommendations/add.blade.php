<x-app-layout title="Administrator">

    <div class="wrapper">
		
		<x-app-aside-admin-layout></x-app-aside-admin-layout>

		<main>
			
			<x-app-navigation-admin-layout></x-app-navigation-admin-layout>
			
			<div class="content">
				<x-app-breadcrumb-admin-layout></x-app-breadcrumb-admin-layout>
				
					<div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="content-body">
                                <h4 class="mb-3">{{ ucwords(Request::segment(3)) }} Rekomendasi Pinjaman</h4>
                                <x-alert></x-alert>
                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="item-body">
                                        <div class="form-group mb-2">
                                            <label for="" class="label"><small>Jumlah Pinjaman</small></label>
                                            <div class="input-group mb-2 mr-sm-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="text" name="nominal" class="form-control" value="{{ isset($recommendation) ? number_format($recommendation->nominal, 0, '.', '.') : '' }}" placeholder="0"/>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="" class="label"><small>Tenor</small></label>
                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="text" name="length_of_loan" class="form-control" value="{{ $recommendation->length_of_loan ?? '' }}" placeholder="Masukan tenor pinjaman"/>
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
                                                        <input type="text" class="form-control instelment" value="{{ isset($recommendation) ? getInstalment($recommendation->nominal, $recommendation->length_of_loan, $setting->interest_rate) : '' }}" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <button class="btn btn-main w-100">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
				
			</div>

			<x-app-footer-admin-layout></x-app-footer-admin-layout>
		</main>

	</div>

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
