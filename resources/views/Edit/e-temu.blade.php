@php
$AuCheck = \App\User::join('roles','roles.id_role','=','users.id_role')                        
                              ->where('id',Auth::id())
                              ->first();
@endphp
@if($AuCheck->n_role == "pengajar")
<!-- MODAL PENGAJAR START -->
<div class="modal fade " id="e-temu{{$tampil->id_pertemuan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Input Pertemuan Ke {{$loop->iteration}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                      <div class="container">
                        <form class="" action="/update/pertemuan/{{$tampil->id_pertemuan}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="k_trans" value="{{$tampil->id_trans}}">
                            <input type="hidden" name="ke" value="{{$loop->iteration}}">
                            <div class="input-group">                                
                                <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan Pertemuan"></textarea>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="keterangan"><i class="fas fa-user"></i></span>
                                </div>
                            </div>
                            <div class="input-group pt-1 ">                                
                                <input type="file" id="bukti_temu" class="form-control p-0 border-0"  name="bukti_temu" id="bukti_temu">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="bukti_temu"><i class="fas fa-envelope"></i></span>
                                </div>
                            </div>                    
                        </div>
                        <div class="modal-footer">            
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="add-button" class="btn btn-success btn-sm">Simpan</button>
                        </form>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
 <!-- MODAL PENGAJAR END -->


@elseif($AuCheck->n_role == "admin" OR $AuCheck->n_role == "super admin")
<!-- MODAL ADMIN START -->
<div class="modal fade " id="e-temu{{$tampil->id_pertemuan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog border-primary modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pertemuan Ke {{$loop->iteration}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                      
            <div class="modal-body">
                <div class="container">
                    <form class="" action="/update/pertemuan/admin/{{$tampil->id_pertemuan}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')        
                            <div class="input-group pt-1 ">                                
                                <select class="form-control" name="konfirm_admin" id="">
                                    <option value="Pertemuan Benar, Upah Telah Dikirim" {{$tampil->status == "Pertemuan Benar, Upah Telah Dikirim"  ? 'selected' : ''}}>Pertemuan Benar, Upah Telah Dikirim</option>
                                    <option value="Transaksi Selesai" {{$tampil->status == "Transaksi Selesai"  ? 'selected' : ''}}>Transaksi Selesai</option>
                                    <option value="Bukti Pertemuan Salah" {{$tampil->status == "Bukti Pertemuan Salah"  ? 'selected' : ''}}>Bukti Pertemuan Salah</option>
                                </select>                                
                            </div> 
                            <div class="input-group pt-1 ">                                
                                <input type="file" id="bukti_upah" class="form-control p-0 border-0"  name="bukti_upah" id="bukti_upah">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="bukti_upah"><i class="fas fa-envelope"></i></span>
                                </div>
                            </div>                    
                </div>
            <div class="modal-footer">            
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" id="add-button" class="btn btn-success btn-sm">Simpan Perubahan</button>
                    </form>
            </div>
        </div>
    </div>
    </div>
</div>
 <!-- MODAL ADMIN END -->

 @elseif($AuCheck->n_role == "client")
<!-- MODAL CLIENT START -->
<div class="modal fade " id="e-temu{{$tampil->id_pertemuan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog border-primary modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pertemuan Ke {{$loop->iteration}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                      
            <div class="modal-body">
                <div class="container">
                    <h4>Apakah Pertemuan Benar ?</h4>
                    <form class="" action="/update/pertemuan/client/{{$tampil->id_pertemuan}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')        
                            <div class="input-group pt-1 ">                                
                                <select class="form-control" name="konfirm_client" id="">
                                    <option value="Benar" {{$tampil->status == "Benar"  ? 'selected' : ''}}>Benar</option>
                                    <option value="Salah" {{$tampil->status == "Salah"  ? 'selected' : ''}}>Salah</option>
                                </select>                                
                            </div>                    
                        </div>
            <div class="modal-footer">            
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" id="add-button" class="btn btn-success btn-sm">Simpan Perubahan</button>
                    </form>
            </div>
        </div>
    </div>
    </div>
</div>
 <!-- MODAL CLIENT END -->
 @endif