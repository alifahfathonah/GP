@extends('layouts.front')
@section('title','Daftar | Gprivat')
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
    @if ($errors)
      @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="fas fa-user"></i>
          {{ $error }}
      </div>
      @endforeach
    @endif
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left pt-5">
                        <h3>Selamat Datang</h3>
                        <p class="pb-5">Login untuk mulai menggunakan jasa kami</p>
                        <a href="/login" class="btn btnReg">Login</a>
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pengguna</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pengajar</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Daftar Sebagai Pengguna</h3>
                                <div class="row register-form">
                                <div class="col-xl-12">
                                <form action="{{ route('register') }}" method="post">
                                @csrf
                                    
                                        <input type="hidden" name="id_role" value="1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap *" >
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email" placeholder="E-Mail *" >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password *" >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password *" >
                                        </div>
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" value="P" checked>
                                                    <span> Pria </span> 
                                                </label>
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" value="W">
                                                    <span>Wanita </span> 
                                                </label>
                                            </div>
                                            <input type="submit" class="btnRegister"  value="Daftar"/>
                                            </form>
                                        </div>
                                    </div>

                                       
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Daftar Sebagai Pengajar</h3>
                                <div class="row register-form">
                                <div class="col-xl-12">
                                <form action="{{ route('register') }}" method="post">
                                @csrf
                                    <input type="hidden" name="id_role" value="2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap *"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email" placeholder="E-Mail *" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password *"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password *" />
                                        </div>
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" value="P" checked>
                                                    <span> Pria </span> 
                                                </label>
                                                <label class="radio inline"> 
                                                    <input type="radio" name="gender" value="W">
                                                    <span>Wanita </span> 
                                                </label>
                                            </div>
                                            <input type="submit" class="btnRegister"  value="Daftar"/>
                                        </div>
                                        </form>
                                    </div>
                    </div>
                </div>

            </div>
@endsection
