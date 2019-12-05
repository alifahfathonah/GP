@extends('layouts.front')
@section('title','Ubah Profil | Gprivat')
@section('content')

<section class="register-block">
    <div class="container-reg">
	<div class="row">
		<div class="col-md-4 register-sec">
		    <h2 class="text-center">Login</h2>
        <form class="register-form" action="/backend/login" method="post">
        @csrf
     <div class="form-group">
    <label for="exampleInputEmail" class="text-uppercase">Email</label>
    <input type="email" name="email" class="form-control" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input type="password" name="password" class="form-control" placeholder="">
  </div>
  
  
  
    <div class="form-check">
    <button type="submit" class="btn btn-register float-right">Submit</button>
  </div>
  
</form>

		</div>
		<div class="col-md-8 banner-sec">
    
      <div class="overlay-login">       
      <img alt="picture" src="{!! asset('storage/img/admin-reg.png')!!}" class="w-25 img-login" />
      <h2 class="text-center text-light">Administrator</h2>
      </div>
      
	</div>
@endsection