@extends('layouts.dash')
@section('title','Data Pertemuan | Gprivat')
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
			<h1 class=" float-left text-custom">Data Pertemuan Transaksi</h1>  <br>  
            

        </div>
        <div class ="clearfix float-left">Catatan : {{$tampils->pluck('note')->first()}}
                <br>
                Pengajar : {{$tampils->pluck('name')->first()}}
</div>
			<div class="widget-content">
				<table class="table table-striped table-bordered">
					<thead class="thead-custom text-light">
						<tr>
							<th>Pertemuan</th>
							<th>Keterangan Pertemuan</th>
							<th width="10%">Bukti Pertemuan</th>                                
                            <th>Tanggal Input</th> 
                            <th width="10%">Konfirmasi Klien</th>             	
							<th class="td-actions"> Aksi</th>
						</tr>
					</thead>					
				@if(count($tampils) <= 0 )
                    <tbody>                            
                        <tr>
                            <td colspan="6"><center> Tidak Ada Pertemuan </center> </td>                                                                      
                        </tr>                            
			        </tbody>
				@else
					@foreach($tampils as $tampil)
						<tbody>
							<tr>
                                
								<td>pertemuan ke {{$loop->iteration}}</td>
								<td>{{$tampil->ket_temu}}</td>
                                @if($tampil->bukti_temu == "")
                                <td></td>
                                @else
					        	<td> 
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#enlargeImageModal{{$tampil->id_pertemuan}}">Lihat Bukti</button>
                                    @include('modal-bukti-temu')
                                </td>
                                @endif
                                @if($tampil->ket_temu == "" OR $tampil->bukti_temu ="")
                                    <td></td>
                                @else
                                    <td>
                                        {{ date('d-m-Y', strtotime($tampil->updated_at))}}
                                    </td>
                                @endif
                                @if($tampil->kon_client == "0")
                                    <td></td>
                                @else
                                    <td>{{$tampil->kon_client}}</td>
                                @endif                        
                                <td>
                                    <button class="btn btn-lg btn-outline-custom btn-circle" data-toggle="modal" data-target="#e-temu{{$tampil->id_pertemuan}}"><i class="fas fa-cog"></i></button>
                                    @include('Edit.e-temu') 

                                </td>
							</tr>
						</tbody>
						@endforeach
					@endif
				</table>
				
				
							
			</div> <!-- /widget-content -->			
		</div> <!-- /widget -->

	<!-- DITERIMA END -->

@endsection