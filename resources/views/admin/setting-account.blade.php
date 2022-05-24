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
                                <h4 class="mb-3">{{ ucwords(Request::segment(3)) }} Karyawan</h4>
                                <x-alert></x-alert>
                                <form method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ auth('admin')->user()->id }}" id="id" class="form-control" placeholder="Masukan nama anda"/>
                                    <input type="hidden" name="status" value="{{ auth('admin')->user()->status }}" id="id" class="form-control" placeholder="Masukan nama anda"/>
                                    <div class="form-group mb-3">
                                        <label for="">Nama</label>
                                        <input type="text" name="name" value="{{ auth('admin')->user()->name }}" id="name" class="form-control" placeholder="Masukan nama anda"/>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="{{ auth('admin')->user()->email }}" id="email" class="form-control" placeholder="Masukan email anda"/>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="*********"/>
                                        <small class="text-danger">Kosongkan jika tidak ingin mengubah</small>
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