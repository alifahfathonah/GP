@extends('layouts.front')
@section('title','Login | Gprivat')
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
                    <div class="col-md-3 register-left">
                    <h3>Selamat Datang</h3>
                        <p class="pb-5">Daftar untuk mulai menggunakan jasa kami</p>
                        <a href="/register" class="btn btnReg">Daftar</a>
                    </div>
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Login</h3>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                <div class="row register-form">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email" name="email" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password" name="password" />
                                        </div>
                                    </div>
                                    
                                        <input type="submit" class="btnRegister w-100"  value="Login"/>
                                        </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
@endsection
