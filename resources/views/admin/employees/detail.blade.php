<x-app-layout title="Administrator">

    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    @endpush

    <div class="wrapper">
		
		<x-app-aside-admin-layout></x-app-aside-admin-layout>

		<main>
			
			<x-app-navigation-admin-layout></x-app-navigation-admin-layout>
			
			<div class="content">
				<x-app-breadcrumb-admin-layout></x-app-breadcrumb-admin-layout>
				
					<div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="content-body">
                                <h4 class="mb-3">Informasi Karyawan</h4>
                                <div class="row form-group">
                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <div class="col-xl-2 col-md-12">Nama</div>
                                            <div class="col-xl-10 col-md-12">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="row">
                                            <div class="col-xl-2 col-md-12">Email</div>
                                            <div class="col-xl-10 col-md-12">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <div class="col-xl-2 col-md-12">Status</div>
                                            <div class="col-xl-10 col-md-12">{!! getUserStatus($user->status) !!}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <div class="col-xl-2 col-md-12">ID Card</div>
                                            <div class="col-xl-10 col-md-12">
                                                <img src="{{ asset('img/' . $user->id_card) }}" alt="ID Card" width="50%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top pt-2">
                                    <a href="{{ route('admin.employee.edit', $user->id) }}" class="btn btn-primary w-100 mb-2"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <a href="{{ route('admin.employee.delete', $user->id) }}" onclick="return confirm('Apakah anda ingin menghapus karyawan?')" class="btn btn-danger w-100"><i class="bi bi-trash"></i> Hapus</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="content-body">
                                <h4 class="mb-3">Riwayat Pengajuan Pinjaman</h4>
                                <div class="table-responsive">
                                    <table id="table" class="row-border stripe">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;">#</th>
                                                <th>Nominal</th>
                                                <th>Tenor</th>
                                                <th>Status</th>
                                                <th class="text-center" style="width: 15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->loans as $i => $loan)
                                                <tr>
                                                    <td>{{ $i+1 }}</td>
                                                    <td>{{ number_format($loan->nominal,0,'.','.') }}</td>
                                                    <td>{{ $loan->length_of_loan }} Bulan</td>
                                                    <td class="text-center">{!! getLoanStatus($loan->status) !!}</td>
                                                    <td class="text-center">
                                                        <div class="d-flex">
                                                            <a href="{{ route('admin.loan.detail', $loan->id) }}" class="badge w-100 me-2 bg-primary p-2"><i class="bi bi-pencil-square"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				
			</div>

			<x-app-footer-admin-layout></x-app-footer-admin-layout>
		</main>

	</div>

    @push('script')
        <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(() => {
                $('#table').DataTable();
            });
        </script>
    @endpush

</x-app-layout>