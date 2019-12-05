@extends('layouts.dash')
@section('title','Data Pesanan | Gprivat')
@section('content')
<div class="container-fluid">
    <div class="clearfix">
    <h1 class=" float-left text-custom">Transaksi Proses Belajar</h1>
    </div>
    <!-- END BAGIAN SEARCH -->
    @if (Session::has('success'))
      <div class="alert alert-success alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-user-tie"></i>
          {{ Session::get('success') }}
      </div>
    @endif
    @if (Session::has('danger'))
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-user-tie"></i>
          {{ Session::get('danger') }}
      </div>
    @endif
    @if ($errors)
      @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-user-tie"></i>
          {{ $error }}
      </div>
      @endforeach
    @endif
    <!-- START BAGIAN TABEL -->
    <div class="container">
      <table class="table table-hover table-striped"> 
          <thead class="thead-custom text-light">
              <th>Kode Transaksi</th>
              <th>Nama Pengajar</th>
              <th>Jumlah Pertemuan</th>
              <th>Harga Pertemuan</th>
              <th>Total Biaya</th>
              <th>Status</th>
              <th>Bukti Pembayaran</th>
                <th>Aksi</th>
             
          </thead>
            @if(count($terima) <= 0 )
                <tbody>                            
                    <tr>
                        <td colspan="9"><center> Tidak Ada Transaksi </center> </td>                                                                      
                    </tr>                            
				</tbody>
			@else
                @foreach($terima as $terimas)
                <tbody>            
                    <td>{{$terimas->id_trans}}</td>
                    <td>{{$terimas->name}}</td> 
                    <td>{{$terimas->jml_temu}}</td> 
                    <td>{{$terimas->hrg_temu}}</td> 
                    <td>{{$terimas->grand_biaya}}</td> 
                    <td>{{$terimas->status}}</td> 
                    <td> 
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#enlargeImageModal{{$terimas->id_trans}}">Lihat Bukti</button>
                        @include('modal-bukti')
                    </td>
                   
                    <td>
                        <a href="/dt-pertemuan/{{$terimas->id_trans}}" class="btn btn-lg btn-outline-custom btn-circle" role="button">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </td>
                 
                @endforeach  
            @endif         
          </tbody>
      </table>
      <!-- END BAGIAN TABEL -->
        <div class="pagination-wrapper pagination-tengah">
			{{$terima->links()}}
	    </div>	
    </div>
  </div>
</div>

@endsection