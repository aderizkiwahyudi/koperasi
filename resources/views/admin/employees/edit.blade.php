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
                                    <div class="form-group mb-3">
                                        <label for="">Nama</label>
                                        <input type="text" name="name" value="{{ $user->name ?? '' }}" id="name" class="form-control" placeholder="Masukan nama anda"/>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="{{ $user->email ?? '' }}" id="email" class="form-control" placeholder="Masukan email anda"/>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="*********"/>
                                        @if (isset($user->id_card))
                                            <small class="text-danger">Kosongkan jika tidak ingin mengubah</small>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Status Akun</label>
                                            <select class="form-control" name="status" id="status">
                                            <option>Pilih Status</option>
                                            <option value="0" {{ isset($user) ? ($user->status == 0 ? 'selected' : '') : '' }}>Pending</option>
                                            <option value="1" {{ isset($user) ? ($user->status == 1 ? 'selected' : '') : '' }}>Aktif</option>
                                            <option value="2" {{ isset($user) ? ($user->status == 2 ? 'selected' : '') : '' }}>Tidak Aktif</option>
                                            </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">ID Card </label>
                                        <input type="file" name="file" id="file" class="form-control" placeholder="Masukan nama anda"/>
                                        @if (isset($user->id_card))
                                            <div class="mt-3">
                                                <img src="{{ asset('img/' . $user->id_card) }}" alt="ID Card" width="50%"/>
                                            </div>
                                        @endif
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