<x-app-layout title="Administrator">

    <div class="wrapper">
		
		<x-app-aside-admin-layout></x-app-aside-admin-layout>

		<main>
			
			<x-app-navigation-admin-layout></x-app-navigation-admin-layout>
			
			<div class="content">
				<x-app-breadcrumb-admin-layout></x-app-breadcrumb-admin-layout>

				<div class="row">
					<div class="col-md-3 mb-3">
						<div class="content-body">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h2>{{ count($users->filter(function($item){ return $item->status == 1; })) }}</h2>
									<small>KARYAWAN</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<div class="content-body">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h2>{{ count($users->filter(function($item){ return $item->status == 0; })) }}</h2>
									<small>STATUS KARYAWAN PENDING</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<div class="content-body">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h2>{{ count($loans->filter(function($item){ return $item->status == 0; })) }}</h2>
									<small>PERMINTAAN PINJAMAN</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<div class="content-body">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h2>{{ count($loans->filter(function($item){ return $item->status == 1; })) }}</h2>
									<small>PINJAMAN AKTIF</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<x-app-footer-admin-layout></x-app-footer-admin-layout>
		</main>

	</div>

</x-app-layout>