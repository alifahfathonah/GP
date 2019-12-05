@extends('layouts.dash')
@section('title','Riwayat Pemesanan | Gprivat')
@section('content')
@if (Session::has('success'))
      <div class="alert alert-success alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-money-bill-alt"></i>
          {{ Session::get('success') }}
      </div>
@endif
@if (Session::has('danger'))
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-money-bill-alt"></i>
          {{ Session::get('danger') }}
      </div>
@endif
@if ($errors)
      @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
		<i class="fas fa-money-bill-alt"></i>
          {{ $error }}
      </div>
      @endforeach
@endif
    @if(\Request::route()->getName() == "trans.ditolak" )
	<!-- DITOLAK START -->
    <div class="clearfix">
        <h1 class=" float-left text-custom">Transaksi Ditolak</h1>    
    </div>
		<div class="widget-content">
			<table class="table table-striped table-bordered">
				<thead class="thead-custom text-light">
					<tr>
						<th>Nama Pengajar</th>
						<th>Jumlah Pertemuan</th>                        
						<th>Harga Pertemuan</th>
                        <th>Total Biaya</th>
                        <th>Tanggal Pesanan</th>
						<th class="td-actions"> Aksi</th>
					</tr>
				</thead>
				@if(count($tolak) <= 0 )
                            <tbody>                            
                                <tr>
                                    <td colspan="6"><center> Tidak Ada Transaksi </center> </td>                                                                      
                                </tr>                            
							</tbody>
				@else
					@foreach($tolak as $tolaks)
					<tbody>
						<tr>
							<td>{{$tolaks->name}}</td>
							<td>{{ $tolaks->jml_temu}}</td>
							
							<td>{{ $tolaks->gaji}}</td>
							<td>{{ $tolaks->total_biaya}}</td>
							<td>{{ date('d-m-Y', strtotime($tolaks->created_at))}}</td>
							<td class="td-actions">
								<form action="/delete/transaksi/{{$tolaks->id}}" class="form-inline" method="post">
									@csrf
									@method('DELETE')
										<button type="submit" class="btn btn-lg btn-outline-custom btn-circle">
										<i class="fas fa-trash"></i>									
										</button>
								</form>
							</td>
						</tr>
					</tbody>
					@endforeach
				@endif
			</table>	
			<div class="pagination-wrapper pagination-tengah">
				{{$tolak->links()}}
			</div>				
		</div> <!-- /widget-content -->			
	</div> <!-- /widget -->
	<!-- DITOLAK END -->
    @else
	<!-- DITERIMA START -->
		<div class="clearfix">
			<h1 class=" float-left text-custom">Transaksi Diterima</h1>    
		</div>
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead class="thead-custom text-light">
						<tr>
							<th>Kode Transaksi</th>
							<th>Nama Pengajar</th>
							<th>Jumlah Pertemuan</th>                        
							<th>Harga Pertemuan</th>
							<th>Total Biaya</th>
							<th>Status</th>
							<th>Bukti Pembayaran</th>
							<th class="td-actions"> Aksi</th>
						</tr>
					</thead>
					<div class="modal fade" id="enlargeImageModal" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
                   <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                       </div>
                       <div class="modal-body">
                         <img src="" class="enlargeImageModalSource" style="width: 100%;">
                       </div>
                     </div>
				   </div>
				   	@if(count($terima) <= 0 )
                            <tbody>                            
                                <tr>
                                    <td colspan="8"><center> Tidak Ada Transaksi </center> </td>                                                                      
                                </tr>                            
							</tbody>
					@else
						@foreach($terima as $terimas)
						<tbody>
							<tr>
								<td>{{$terimas->id_trans}}</td>
								<td>{{$terimas->name}}</td>
								<td>{{$terimas->jml_temu}}</td>
								
								<td>{{ $terimas->hrg_temu}}</td>
								<td>{{ $terimas->grand_biaya}}</td>
								<td>{{ $terimas->status}}</td>

								
								<td> 
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#enlargeImageModal{{$terimas->id_trans}}">Lihat Bukti Pembayaran</button>
									@include('modal-bukti')
								</td>


								<td class="td-actions">
									<form action="/upload/transaksi/{{$terimas->id_trans}}" class="form-inline" method="post"enctype="multipart/form-data" id="buktiForm{{$terimas->id_trans}}" novalidate>
										@csrf
										@method('PUT')
											<button type="button" class="btn btn-lg btn-outline-custom btn-circle" id="bukti{{$terimas->id_trans}}" name="konfirmasi" value="denied">
											<i class="fas fa-upload"></i>									
											</button>
											<input type="file" onchange="buktiUp()" id="img-bukti{{$terimas->id_trans}}" name="bukti" style="display: none;">

											<script>
												$('#bukti{{$terimas->id_trans}}').click(function(){
													$('#img-bukti{{$terimas->id_trans}}').click()
												});													
											</script> 
											<script>
											function buktiUp() {
												var form = document.getElementById('buktiForm{{$terimas->id_trans}}');
												form.submit();
											};                
											</script>
									</form>
								</td>
							</tr>
						</tbody>
						@endforeach
					@endif
				</table>
				
				<div class="pagination-wrapper pagination-tengah">
					{{$terima->links()}}
				</div>	
							
			</div> <!-- /widget-content -->			
		</div> <!-- /widget -->

	<!-- DITERIMA END -->
    @endif
@endsection