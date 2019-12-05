@extends('layouts.dash')
@section('title','Daftar Pesanan | Gprivat')
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

<div class="widget stacked widget-table action-table">
    				
				<!-- <div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>Daftar Pesanan</h3>
				</div> /widget-header -->
                <div class="clearfix">
                    <h1 class=" float-left text-custom">Daftar Pemesanan</h1>
                        
                </div>
				<div class="widget-content">
					
					<table class="table table-striped table-bordered">
						<thead class="thead-custom text-light">
							<tr>
								<th>Nama Klien</th>
								<th>Jumlah Pertemuan</th>
                                <th>Kota Tinggal</th>
								<th>Harga Pertemuan</th>
								<th>Total Biaya</th>
								<th>Catatan Pemesanan</th>
								<th class="td-actions"> Aksi</th>
							</tr>
						</thead>
						@if(count($list_book) <= 0 )
                            <tbody>                            
                                <tr>
                                    <td colspan="7"><center> Tidak Ada Pesanan </center> </td>                                                                      
                                </tr>                            
							</tbody>
						@else
							@foreach($list_book as $book)
							<tbody>
							
								<tr>
									<td>{{$book->name}}</td>
									<td>{{ $book->jml_temu}}</td>
									<td>{{ $book->kota}}</td>
									<td>{{ $book->gaji}}</td>
									<td>{{ $book->total_biaya}}</td>
									<td>{{ $book->note}}</td>
									<td class="td-actions">
									<form action="/create/dt-booking/{{$book->id_client}}/{{$book->id}}" class="form-inline" method="post">
										@csrf
										<input type="hidden" name="j_temu" value="{{ $book->jml_temu}}">
										<input type="hidden" name="grand" value="{{ $book->total_biaya}}">
										<input type="hidden" name="harga" value="{{ $book->gaji}}">
										<input type="hidden" name="note" value="{{ $book->note}}">

										<button class="btn btn-lg btn-outline-custom btn-circle" name="konfirmasi" value="accept">
										<i class="fas fa-check"></i>
										</button>
																			
									
									
										<button class="btn btn-lg btn-outline-custom btn-circle" name="konfirmasi" value="denied">
										<i class="fas fa-times"></i>									
										</button>
									</form>
									</td>
								</tr>
							
								</tbody>
								@endforeach
							@endif
						</table>
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->
@endsection