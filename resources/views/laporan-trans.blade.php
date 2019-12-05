@extends('layouts.dash')
@section('title','Laporan Transaksi | Gprivat')
@section('content')
 <!-- START BAGIAN TABEL -->
 <div class="container">
    <form method="post" action="/laporan/search" enctype="multipart/form-data" novalidate>
        @csrf
        <h3 class="text-custom">Pencarian</h3>
        <input id="" type="date" class="form-control  w-100 my-2" placeholder="Tanggal Awal" name="tgl_awal"  >
        <input id="harga" type="date" class="form-control w-100 my-2" placeholder="Tanggal Akhir" name="tgl_akhir"  >
         <div class="form-group row mb-0">
            <button class="btn btn-outline-secondary form-control1 mt-3 w-100" name="AksiFilter" value="Filter">
                Filter
            </button>
        </div>

    </form>
    @if(\Request::route()->getName() == "laporan.search" )
        <form action="/laporan/download" method="post">
            @csrf
            <input type="hidden" name="filawal" value="{{ $tgawal  }}">
            <input type="hidden" name="filakhir" value="{{ $tgakhir  }}">
                @if($tgawal > $tgakhir)
                    <button class="btn btn-info" type="submit" disabled>Unduh PDF</button>
                @else
                    <button class="btn btn-info" type="submit" formtarget="_blank">Unduh PDF</button>
                @endif
        </form>
    @else
    @endif
      <table class="table table-hover table-striped"> 
          <thead class="thead-custom text-light">
              <th>Kode Transaksi</th>
              <th>Nama Klien</th>
              <th>Nama Pengajar</th>
              <th>Jumlah Pertemuan</th>
              <th>Harga Pertemuan</th>
              <th>Total Biaya</th>
              <th>Status</th>  
              <th>Tanggal Transaksi</th>          
          </thead>
          @if(\Request::route()->getName() == "laporan.search" )
            @if(count($filter) <= 0 )
                <tbody>                            
                    <tr>
                        <td colspan="7"><center> Tidak Ada Transaksi </center> </td>                                                                      
                    </tr>                            
                </tbody>
            @else
                @foreach($filter as $show)
                <tbody>            
                    <td>{{$show->id_trans}}</td>
                    <td>{{$show->n_client}}</td>
                    <td>{{$show->n_pengajar}}</td> 
                    <td>{{$show->jml_temu}}</td> 
                    <td>{{$show->hrg_temu}}</td> 
                    <td>{{$show->grand_biaya}}</td> 
                    <td>{{$show->status}}</td>     
                    <td>{{date('d-m-Y', strtotime($show->created_at))}}</td>                  
                @endforeach  
            @endif
         @else
            @if(count($shows) <= 0 )
                <tbody>                            
                    <tr>
                        <td colspan="7"><center> Tidak Ada Transaksi </center> </td>                                                                      
                    </tr>                            
				</tbody>
			@else
                @foreach($shows as $show)
                <tbody>            
                    <td>{{$show->id_trans}}</td>
                    <td>{{$show->n_client}}</td>
                    <td>{{$show->n_pengajar}}</td> 
                    <td>{{$show->jml_temu}}</td> 
                    <td>{{$show->hrg_temu}}</td> 
                    <td>{{$show->grand_biaya}}</td> 
                    <td>{{$show->status}}</td>     
                    <td>{{date('d-m-Y', strtotime($show->created_at))}}</td>                  
                @endforeach  
            @endif
        @endif         
          </tbody>
      </table>
      <!-- END BAGIAN TABEL -->

@endsection