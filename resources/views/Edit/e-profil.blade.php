@extends('layouts.dash')
@section('title','Ubah Profil | Gprivat')
@section('content')
@if ($errors)
      @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-user"></i>
          {{ $error }}
      </div>
      @endforeach
@endif
    <div class="container-fluid">
    <div class="card">
        <div class="card-header bg-light"> <h4>Ubah Profil</h4></div>
        <div class="card-body">

       
        @if(Auth::user()->id_role == 1)
         @include('Edit.e-profil-client')
        
        @else
        @include('Edit.e-profil-pengajar')
        @endif

<!-- END CARD -->

        
    </div>


@endsection