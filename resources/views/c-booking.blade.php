@extends('layouts.dash')
@section('title','Daftar Pesanan | Gprivat')
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

<div class="widget stacked widget-table action-table">
    				
				<!-- <div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>Daftar Pesanan</h3>
				</div> /widget-header -->
                <div class="clearfix">
                    <h1 class=" float-left text-custom">Transaksi Pending </h1>
                        
                </div>
				<div class="widget-content">
					
					<table class="table table-striped table-bordered">
						<thead class="thead-custom text-light">
							<tr>
								<th>Nama Pengajar</th>
								<th>Jumlah Pertemuan</th>
                                <th>Kota Tinggal Klien</th>
								<th>Harga Pertemuan</th>
                                <th>Total Biaya</th>
								<th>Catatan Pemesanan</th>
							</tr>
                        </thead>
                        @if(count($pending) <= 0 )
                            <tbody>                            
                                <tr>
                                    <td colspan="6"><center> Tidak Ada Pesanan </center> </td>                                                                      
                                </tr>                            
                            </tbody>
                        @else
                            @foreach($pending as $book)
                                <tbody>                            
                                    <tr>
                                        <td>{{$book->name}}</td>
                                        <td>{{ $book->jml_temu}}</td>
                                        <td>{{ $book->kota}}</td>
                                        <td>{{ $book->gaji}}</td>
                                        <td>{{ $book->total_biaya}}</td>                                    
                                        <td>{{ $book->note}}</td> 
                                    </tr>                            
                                </tbody>                        
                            @endforeach
                        @endif
						</table>
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->
@endsection