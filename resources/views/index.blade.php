@extends('layouts.front')
@section('content')

@include('layouts.slider')
@if (Session::has('success'))
      <div class="alert alert-success alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="far fa-calendar-check"></i>
          {{ Session::get('success') }}
      </div>
@endif
@if (Session::has('danger'))
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="far fa-calendar-check"></i>
          {{ Session::get('danger') }}
      </div>
@endif
@if ($errors)
      @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a>
        <i class="far fa-calendar-check"></i>
          {{ $error }}
      </div>
      @endforeach
    @endif
<div class="row pt-5 mx-3" >


@foreach($semua as $all)
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                @if($all->foto == "")
                                   <p> <img class="img-fluid" src="{!! asset('storage/img/profile.png')!!}"
                                        alt="User picture">
                                    </p>
                                @else
                                    <p><img class=" img-fluid" src="{!! asset('storage/'.$all->foto) !!}" alt="card image"></p>
                                @endif
                                    <h4 class="card-title">{{$all->name}}</h4>
                                        <p class="card-text">
                                            {{$all->gaji}}/pertemuan <br>
                                            Keahlian : {{$all->n_keahlian}} <br>
                                            Kota Jangkauan : {{$all->area}} <br>
                                        
                                        </p>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <h4 class="card-title">Deskripsi Pengajar</h4>
                                    <p class="card-text">
                                    {{$all->keterangan}}                             <br>
                                    Jadwal Kerja : {{ implode(', ',json_decode($all->hari)) }}<br>
                                    </p>
                                    <button class="btn btn-outline-success" data-toggle="modal" data-target="#c-booking{{$all->id_pengajar}}">Pesan Jasa</button>
                                </div>
                                Catatan : 1 kali pertemuan = 2 Jam Pelajaran <br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            @include('create.c-pesan')
           
            <!-- ./Team member -->
            @endforeach
            
@endsection