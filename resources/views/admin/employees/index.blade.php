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
				
				<div class="content-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Daftar Karyawan</h4>
                            <small>Berikut adalah daftar karyawan yang terdaftar</small>
                        </div>
                        <div>
                            <a href="{{ route('admin.employee.add') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</a>
                        </div>
                    </div>
					<div class="content-body-item">
                        <x-alert></x-alert>
                        <div class="table-responsive">
                            <table id="table" class="row-border stripe">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $i => $user)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td><a href="{{ route('admin.employee.detail', $user->id) }}">{{ $user->name }}</a></td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">{!! getUserStatus($user->status) !!}</td>
                                            <td class="text-center">
                                                <div class="d-flex">
                                                    <a href="{{ route('admin.employee.edit', $user->id) }}" class="badge w-100 me-2 bg-primary p-2"><i class="bi bi-pencil-square"></i> Edit</a>
                                                    <a href="{{ route('admin.employee.delete', $user->id) }}" class="badge w-100 bg-danger p-2" onclick="return confirm('Apakah anda ingin menghapus data?')"><i class="bi bi-trash"></i> Hapus</a>
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