<x-app-layout title="Laporan Pinjaman" lastTitle="Sistem Koperasi PT. UNGARAN SARI GARMENT">

    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    @endpush

    <div class="wrapper">
		
		<x-app-aside-admin-layout></x-app-aside-admin-layout>

		<main>
			
			<x-app-navigation-admin-layout></x-app-navigation-admin-layout>
			
			<div class="content">
				<x-app-breadcrumb-admin-layout></x-app-breadcrumb-admin-layout>
				
				<div class="content-body">
					<h4>Daftar Angsuran</h4>
					<small>Angsuran yang sudah dilakukan</small>
					<div class="content-body-item">
                        <x-alert></x-alert>
                        <div class="table-responsive">
                            <table id="table" class="row-border stripe">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Angsuran (Rp)</th>
                                        <th>Cicilan (Rp)</th>
                                        <th>Total Cicilan (Rp)</th>
                                        <th>Tenor</th>
                                        <th>Tgl. Peminjaman</th>
                                        <th>Tgl. Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instalments as $i => $instalment)
                                        <tr>
                                            <td></td>
                                            <td>{{ getUserWithId($instalment->loan->user_id) }}</td>
                                            <td>{{ number_format($instalment->nominal, 0, '.', '.') }}</td>
                                            <td>{{ getInstalment($instalment->loan->nominal, $instalment->loan->length_of_loan, $instalment->loan->interest_rate) }}/Bulan</td>
                                            <td>{{ countInstalment($instalment->loan->nominal, $instalment->loan->length_of_loan, $instalment->loan->interest_rate) }}</td>
                                            <td>{{ $instalment->loan->length_of_loan }} Bulan</td>
                                            <td>{{ date('d/m/Y', strtotime($instalment->loan->acc_at)) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($instalment->created_at)) }}</td>
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
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(() => {
                var t = $('#table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excel',
                        },
                        {
                            extend: 'print',
                            customize: function (win) {
                                $(win.document.body).find('table')
                                    .addClass('text-start')
                                    .css('font-size', 'inherit');
                                $(win.document.body).find('h1')
                                    .addClass('mb-4')
                                    .css('font-size', '16pt')
                                    .css('text-align', 'center');
                            }
                        }
                    ],
                });

                t.on('order.dt search.dt', function () {
                    let i = 1;
            
                    t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                        this.data(i++);
                    });
                }).draw();
            });
        </script>
    @endpush

</x-app-layout>