@extends('layouts.dash')
@section('title','Data Transaksi | Gprivat')
@section('content')
<div class="container-fluid">
    <div class="clearfix">
    @if(\Request::route()->getName() == "trans.data.konf" )
      <h1 class=" float-left text-custom">Data Transaksi Butuh Konfirmasi</h1>
    @elseif(\Request::route()->getName() == "trans.data.proc" )
        <h1 class=" float-left text-custom">Data Transaksi Proses Belajar</h1>
    @elseif(\Request::route()->getName() == "trans.data.all" )
        <h1 class=" float-left text-custom">Data Transaksi Semua</h1>
    @else
        <h1 class=" float-left text-custom">Data Transaksi Selesai</h1>
    @endif

    </div>

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
              <th>Nama Klien</th>
              <th>Nama Pengajar</th>
              <th>Jumlah Pertemuan</th>
              <th>Harga Pertemuan</th>
              <th>Total Biaya</th>
              <th>Status</th>
              @if(\Request::route()->getName() == "trans.data.proc" )
                <th>Aksi</th>
              @elseif(\Request::route()->getName() == "trans.data.finish" )

              @else
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
              @endif
          </thead>
            @if(count($shows) <= 0 )
                <tbody>                            
                    <tr>
                        <td colspan="9"><center> Tidak Ada Transaksi </center> </td>                                                                      
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
                    @if(\Request::route()->getName() == "trans.data.proc" )
                    <td>
                        <a href="/pertemuan/{{$show->id_trans}}" class="btn btn-lg btn-outline-custom btn-circle" role="button">
                          <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </td>
                    @elseif(\Request::route()->getName() == "trans.data.finish" )

                    @else
                        <td> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#enlargeImageModal{{$show->id_trans}}">Lihat Bukti</button>
                            @include('modal-bukti')
                        </td>
                        <td> 
                            <button class="btn btn-lg btn-outline-custom btn-circle" data-toggle="modal" data-target="#e-trans{{$show->id_trans}}"><i class="fas fa-cog"></i></button>
                            @include('Edit.e-trans')   
                        </td> 
                    @endif
        
                @endforeach  
            @endif         
          </tbody>
      </table>
      <!-- END BAGIAN TABEL -->
        <div class="pagination-wrapper pagination-tengah">
			{{$shows->links()}}
	    </div>	
    </div>
  </div>
</div>

@endsection