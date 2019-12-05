@extends('layouts.dash')
@section('title','Data Keahlian | Gprivat')
@section('content')
<div class="container-fluid">
    <div class="clearfix">
      <h1 class=" float-left text-custom">Data Keahlian</h1>
      </div>
    <!-- END BAGIAN SEARCH -->
    @if (Session::has('success'))
      <div class="alert alert-success alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-wrench"></i>
          {{ Session::get('success') }}
      </div>
    @endif
    @if (Session::has('danger'))
      <div class="alert alert-success alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-wrench"></i>
          {{ Session::get('danger') }}
      </div>
    @endif
    @if ($errors)
      @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-wrench"></i>
          {{ $error }}
      </div>
      @endforeach
    @endif
    <!-- START BAGIAN TABEL -->
    <div class="container">
      <table class="table table-hover table-striped"> 
          <thead class="thead-custom text-light">
              <th>ID Keahlian</th>
              <th>Nama Keahlian</th>
              <th>Aksi</th>
          </thead>
          @foreach($keahlians as $ahli)
          <tbody>            
              <td>{{$ahli->id_keahlian}}</td>
              <td>{{$ahli->n_keahlian}}</td>
              <td> <button class="btn btn-lg btn-outline-custom btn-circle" data-toggle="modal" data-target="#e-keahlian{{$ahli->id_keahlian}}"><i class="far fa-edit"></i></button>
            
              @include('Edit.e-keahlian')
             
              <button class="btn btn-lg btn-outline-custom btn-circle" data-toggle="modal" data-target="#d-keahlian{{$ahli->id_keahlian}}"><i class="fas fa-trash"></i></button>
              @include('delete.d-keahlian')
                </td> 
            @endforeach           
          </tbody>
      </table>
      <!-- END BAGIAN TABEL -->
    </div>
    <!-- <center><a href="/create/keahlian" class="btn btn-success" role="button">  <i class="fa fa-plus-circle"></i> Tambah Data Keahlian</a></CENTER> -->
    <center><button  type="button" class="btn btn-success  w-75" role="button" data-toggle="modal" data-target="#exampleModalCenter">
    <i class="fa fa-plus-circle"></i> Tambah Data Keahlian</button></center> 
    @include('create.c-keahlian')
  </div>
</div>
@endsection