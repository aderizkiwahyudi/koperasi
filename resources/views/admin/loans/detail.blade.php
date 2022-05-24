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
                        <div class="item content-body">
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
                                    <p>Total Cicilan</p>
                                    <p>{{ countInstalment($loan->nominal, $loan->length_of_loan, $loan->interest_rate) }}</p>
                                </div>
                                <div class="item-loans d-flex align-items-center justify-content-between">
                                    <p>Status Pencairan</p>
                                    <p>{!! getLoanStatus($loan->status) !!}</p>
                                </div>
                                <div class="item-loans d-flex align-items-center justify-content-between">
                                    <p>Tanggal Pengajuan</p>
                                    <p>{{ $loan->acc_at ? date('d/m/Y', strtotime($loan->created_at)) : '-'; }}</p>
                                </div>
                                <div class="item-loans d-flex align-items-center justify-content-between">
                                    <p>Tanggal Disetujui</p>
                                    <p>{{ $loan->acc_at ? date('d/m/Y', strtotime($loan->acc_at)) : '-'; }}</p>
                                </div>
                                <div class="item-loans d-flex align-items-center justify-content-between">
                                    <p>Tempo</p>
                                    <p>{{ $loan->acc_at ? date('d/m/Y', strtotime("+ ".$loan->length_of_loan." month" ,strtotime($loan->acc_at))) : '-'; }}</p>
                                </div>
                            </div>
                            @if ($loan->status == 0)
                                <div class="item-footer mt-3">
                                    <a href="{{ route('admin.loan.action', [$loan->id, 1]) }}" class="btn btn-success w-100 mb-2">Terima</a>
                                    <a href="{{ route('admin.loan.action', [$loan->id, 2]) }}" class="btn btn-danger w-100">Tolak</a>
                                </div>
                            @elseif($loan->status == 1)
                                <div class="item-footer mt-3">
                                    <a href="{{ route('admin.loan.action', [$loan->id, 3]) }}" class="btn btn-success w-100 mb-2">Lunas</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="content-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="mb-3">Informasi Karyawan</h4>
                                <a href="{{ route('admin.employee.detail', $loan->user->id) }}"><span class="badge bg-primary"><i class="bi bi-eye"></i></span></a>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 mb-2">
                                    <div class="row">
                                        <div class="col-xl-2 col-md-12">Nama</div>
                                        <div class="col-xl-10 col-md-12">{{ $loan->user->name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="row">
                                        <div class="col-xl-2 col-md-12">Email</div>
                                        <div class="col-xl-10 col-md-12">{{ $loan->user->email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="content-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">Riwayat Cicilan</h4>
                                    <small>Daftar Riwayat Pembayaran Cicilan</small>
                                </div>
                                <div>
                                    <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#add"><span class="badge bg-primary p-2"><i class="bi bi-plus"></i> Tambah</span></a>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form method="post">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Pembayaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label for="">Nominal</label>    
                                                            <input type="text" name="nominal" class="form-control" placeholder="0"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Tanggal Pembayaran</label>    
                                                            <input type="date" name="created_at" class="form-control" value="{{ date('Y-m-d') }}"/>
                                                        </div>     
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-main">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <x-alert></x-alert>
                            <div class="table-responsive">
                                <table id="table" class="stripped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Nominal</th>
                                            <th class="text-center" style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($loan->installments as $i => $installment)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ date('d/m/Y', strtotime($installment->created_at)) }}</td>
                                                <td>Rp {{ number_format($installment->nominal, 0, '.', '.') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="me-2">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-{{ $installment->id }}" class="badge w-100 me-2 bg-primary p-2"><i class="bi bi-pencil-square"></i> Edit</a>
                                                            
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="edit-{{ $installment->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <form method="post" action="{{ route('admin.instalment.edit', $installment->id) }}">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Tambah Pembayaran</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group mb-3">
                                                                                    <label for="">Nominal</label>    
                                                                                    <input type="text" name="nominal" value="{{ number_format($installment->nominal, 0, '.', '.') }}" class="form-control" placeholder="0"/>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="">Tanggal Pembayaran</label>    
                                                                                    <input type="date" name="created_at" class="form-control" value="{{ date('Y-m-d', strtotime($installment->created_at)) }}"/>
                                                                                </div>     
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-main">Simpan</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('admin.instalment.delete', $installment->id) }}" class="badge w-100 bg-danger p-2" onclick="return confirm('Apakah anda ingin menghapus data?')"><i class="bi bi-trash"></i> Hapus</a>
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
        <script src="{{ asset('js/rupiah.js') }}"></script>
        <script>
            $(document).ready(() => {
                $('#table').DataTable();

                $('input[name="nominal"]').on('keyup', function (){  
                    let val = $(this).val();
                    return $(this).val(rupiah(val));
                })
            });
        </script>
    @endpush

</x-app-layout>