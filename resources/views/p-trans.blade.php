@extends('layouts.dash')
@section('title','Data Transaksi | Gprivat')
@section('content')
@if (Session::has('success'))
      <div class="alert alert-success alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-user"></i>
          {{ Session::get('success') }}
      </div>
@endif
@if (Session::has('danger'))
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-user"></i>
          {{ Session::get('danger') }}
      </div>
@endif
<!-- RIWAYAT TRANSAKSI START -->
<div class="clearfix">
			<h1 class=" float-left text-custom">Riwayat Transaksi</h1>    
		</div>
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead class="thead-custom text-light">
						<tr>
							<th>Kode Transaksi</th>
							<th>Nama Klien</th>
							<th>Jumlah Pertemuan</th>                        
							<th>Harga Pertemuan</th>
							<th>Total Biaya</th>
							<th>Status</th>
							<th>Catatan Pemesanan</th>
						
							<th class="td-actions"> Aksi</th>
						</tr>
					</thead>					
				   	@if(count($riwayat) <= 0 )
              <tbody>                            
                <tr>
                  <td colspan="8"><center> Tidak Ada Transaksi </center> </td>                                                                      
                </tr>                            
							</tbody>
					@else
						@foreach($riwayat as $terimas)
						<tbody>
							<tr>
								<td>{{$terimas->id_trans}}</td>
								<td>{{$terimas->name}}</td>
								<td>{{$terimas->jml_temu}}</td>
								
								<td>{{ $terimas->hrg_temu}}</td>
								<td>{{ $terimas->grand_biaya}}</td>
								<td>{{ $terimas->status}}</td>	
								<td>{{ $terimas->note}}</td>	
								@if($terimas->status == "Menunggu Pembayaran Client")
									<td></td>	
								@else			
									<td class="td-actions">
										<a href="/pertemuan/{{$terimas->id_trans}}" class="btn btn-lg btn-outline-custom btn-circle" role="button">
										<i class="fas fa-sign-in-alt"></i>
										</a>
									</td>
								@endif
							</tr>
						</tbody>
						@endforeach
					@endif
				</table>
				
				<div class="pagination-wrapper pagination-tengah">
					{{$riwayat->links()}}
				</div>	
							
			</div> <!-- /widget-content -->			
		</div> <!-- /widget -->

	<!-- DITERIMA END -->

@endsection