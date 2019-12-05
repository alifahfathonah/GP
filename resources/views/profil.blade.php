@extends('layouts.dash')
@section('title','Profil | Gprivat')
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
    <div class="container-fluid">
    <div id="user" class="profile" >
    <div class="row ">
        <div class="col-md-4 col-sm-12 text-center mt-3 img-hover tengah">
        @if(Auth::user()->id_role == 2)
        <form action="/update/avatar/{{Auth::user()->email}}" method="post" enctype="multipart/form-data" id="avatarForm" novalidate>
        @csrf
        @method('PUT')
        
            <div class="rounded-circle wrap border shadow">    
            @if( Auth::user()->join('pengajars','pengajars.email','=','users.email')->find(Auth::id())->foto == "" )
   
                <img alt="picture" src="{!! asset('storage/img/profile.png')!!}" class="img-lg " />
                <div class="overlay ctr">            
                    <button type="button" id="prof-pic" class=" btn btn-sm btn-outline-light">Change Picture</button>
                    <input type="file" onchange="upload()" id="img-profile" name="avatar" style="display: none;">
                </div>    
                <script>
                    $('#prof-pic').click(function(){
                        $('#img-profile').click()
                    });
                            
                </script> 
                <script>
                function upload() {
                    var form = document.getElementById('avatarForm');
                    form.submit();
                };
                
                </script>
            @else
            <img alt="Foto" src="{!! asset('storage/'.$pengajarss->pluck('foto')->first())!!}" class="img-lg " />
            
                <div class="overlay ctr">            
                    <button type="button" id="prof-pic" class=" btn btn-sm btn-outline-light">Change Picture</button>
                    <input type="file" onchange="upload()" id="img-profile" name="avatar" style="display: none;">
                </div>    
                <script>
                    $('#prof-pic').click(function(){
                        $('#img-profile').click()
                    });
                            
                </script> 
                <script>
                function upload() {
                    var form = document.getElementById('avatarForm');
                    form.submit();
                };
                
                </script>
            @endif
            </form>  
            
        @else
            <div class="rounded-circle wrap border shadow">    
            <img alt="picture" src="{!! asset('storage/img/profile.png')!!}" class="img-lg " />
         @endif
            </div>
        </div>
    </div>
    <hr>
      <div class="row">
      @if(Auth::user()->id_role == 1)
      @foreach($data as $profil)
        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
         <p>Nama : {{$profil->name}} </p>
        </div>
        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
         <p>Email : {{$profil->email}}</p>
        </div>      
        <!-- FOR CLIENT START -->
        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
         <p>No. Telepon : {{$profil->nope}}</p>
        </div>
        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
         <p>Kota : {{$profil->kota}}</p>
        </div>
        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
         <p>Alamat : {{$profil->alamat}}</p>
        </div>
        <div class="form-group col-md-12">
         <p>Password : <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#e-pass{{$profil->id}}">Ubah Password</button></p>
                @include('Edit.e-pass-client')
        </div>
        <!-- FOR CLIENT END -->
       
        @endforeach
  
        @elseif(Auth::user()->id_role == 2)
      
            @foreach($pengajarss as $prof)
        <!-- FOR PENGAJAR START -->
            <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                <p>Nama : {{$prof->name}} </p>
            </div>
            <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                <p>Email : {{$prof->email}}</p>
            </div>     
            <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                <p>Lokasi / Area Kerja : {{$prof->area}}</p>
            </div>
            <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                <p>Keahlian : {{$prof->n_keahlian}} </p>
            </div>
            <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                <p>No. Rekening : {{$prof->norek}} </p>
            </div>
            <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                <p>Harga Jasa : Rp. {{$prof->gaji}} / pertemuan</p>
            </div>
            <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
             <p class="p-inline">Status Aktif :
                 <form action="/update/status/{{$prof->email}}" class="f-inline" method="post">
                 @csrf
                 @if($prof->st_aktif == "0")
                   <button name="status" value="1" class="btn btn-outline-secondary"> Tidak Aktif</button>
                 @else
                     <button name="status" value="0" class="btn btn-outline-success">Aktif</button>
                 @endif
                </form>
            </p>
            </div>
            
            <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
                <p>Jadwal Ajar :<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#e-jadwal{{$prof->id}}">Atur Jadwal Ajar</button></p>
                @include('Edit.e-jadwal')
             </div>  
        <div class="form-group col-md-12">
         <p>Password : <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#e-pass{{$prof->id}}">Ubah Password</button></p>
                @include('Edit.e-pass-pengajar')
        </div>
        @endforeach
        <!-- FOR PENGAJAR END -->
        @else
        @foreach($data as $profil)
        <!-- FOR ADMIN START -->
        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
         <p>Nama : {{$profil->name}} </p>
        </div>
        <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4">
         <p>Email : {{$profil->email}} </p>
        </div>      
        <div class="form-group col-md-12">
         <p>Password : <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#e-pass{{$profil->id}}">Ubah Password</button></p>
                @include('Edit.e-pass-client')
        </div>
        <!-- FOR ADMIN END -->
        @endforeach
        @endif

      </div> 
      @if(Auth::user()->id_role == "3" OR Auth::user()->id_role =="4")
      @else
       <center><a href="/edit/profil/{{ Auth::id() }}" class="btn btn-sm btn-success">Ubah Profil</a></center>
      @endif
    </div>


@endsection