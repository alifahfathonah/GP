@extends('layouts.front')
@section('title','Home | Guru Privat')
@section('content')
 <!-- Team member -->
<div class="container-fluid">
<div class="row pt-5 mx-3" >
@foreach($list as $lists)
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                @if($lists->foto == "")
                                   <p> <img class="img-fluid" src="{!! asset('storage/img/profile.png')!!}"
                                        alt="User picture">
                                    </p>
                                @else
                                    <p><img class=" img-fluid" src="{!! asset('storage/'.$lists->foto) !!}" alt="card image"></p>
                                @endif
                                    <h4 class="card-title">{{$lists->name}}</h4>
                                        <p class="card-text">
                                            Rp.{{$lists->gaji}}/pertemuan <br>
                                            Keahlian : {{$lists->n_keahlian}} <br>
                                            Area Kerja : {{$lists->area}} <br>
                                        
                                        </p>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <h4 class="card-title">Deskripsi Pengajar</h4>
                                    <p class="card-text">
                                        {{$lists->keterangan}} <br>
                                        Jadwal Kerja : {{ implode(', ',json_decode($lists->hari)) }}<br>
                                        
                                    </p>
                                    <button class="btn btn-outline-success" data-toggle="modal" data-target="#c-booking{{$lists->id_pengajar}}">Pesan Jasa</button>

                                </div>
                                Catatan : 1 kali pertemuan = 2 Jam Pelajaran <br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('create.c-booking')

            <!-- ./Team member -->
@endforeach
</div>
@endsection