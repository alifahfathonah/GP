@extends('layouts.dash')
@section('title','Data Admin | Gprivat')
@section('content')
<div class="container-fluid">
    <div class="clearfix">
      <h1 class=" float-left text-custom">Data Admin</h1>
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
              <th>Nama Admin</th>
              <th>E-Mail</th>
              <th>Hak Akses</th>
              <th>Aksi</th>
          </thead>
          @foreach($admin_list as $adm)
          <tbody>            
              <td>{{$adm->name}}</td>
              <td>{{$adm->email}}</td>
              <td>{{$adm->n_role}}</td>
              <td> <button class="btn btn-lg btn-outline-custom btn-circle" data-toggle="modal" data-target="#e-admin{{$adm->id}}"><i class="far fa-edit"></i></button>
                    @include('Edit.e-admin')     
                
                <button  class="btn btn-lg btn-outline-custom btn-circle" data-toggle="modal" data-target="#d-admin{{$adm->id}}" {{$adm->id == Auth::id()  ? 'disabled' : ''}}><i class="fas fa-trash"></i></button>
                  @include('delete.d-admin')  
                </td> 
            @endforeach           
          </tbody>
      </table>
      <!-- END BAGIAN TABEL -->
    </div>
    <center><button  type="button" class="btn btn-success  w-75" role="button" data-toggle="modal" data-target="#c-admin">
    <i class="fa fa-plus-circle"></i> Tambah Admin Baru</button></center> 
    @include('create.c-admin')
  </div>
</div>
@endsection