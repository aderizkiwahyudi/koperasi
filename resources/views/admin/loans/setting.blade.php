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
                                <h4 class="mb-3">Pengaturan Pinjaman</h4>
                                <x-alert></x-alert>
                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="">Bunga</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <input type="number" name="interest_rate" value="{{ $settings->interest_rate }}" id="name" class="form-control" placeholder="Masukan bunga pinjaman"/>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Batas Tenor</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <input type="number" name="max_length_of_loan" value="{{ $settings->max_length_of_loan ?? '' }}" id="email" class="form-control" placeholder="Masukan batas maksimal tenor"/>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Bulan</div>
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

</x-app-layout>