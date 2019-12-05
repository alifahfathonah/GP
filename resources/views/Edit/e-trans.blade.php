<!-- Modal -->
<div class="modal fade " id="e-trans{{$show->id_trans}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Status Transaksi : {{$show->id_trans}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                      <div class="container">
                        <form class="" action="/update/dt-trans/{{$show->id_trans}}" method="post">
                            @csrf
                            @method('put')     
                            <input type="hidden" name="j_temu" value="{{ $show->jml_temu}}">
                            <input type="hidden" name="id_client" value="{{ $show->id_client}}">

                            <div class="input-group pt-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="status"><i class="fas fa-scroll"></i></span>
                                </div>
                                <select name="status" id="status" class="form-control">
                                   <option value="Pemesanan Dibatalkan" {{$show->status == "Pemesanan Dibatalkan"  ? 'selected' : ''}}>Pemesanan Dibatalkan</option>
                                   <option value="Bukti Pembayaran Salah" {{$show->status == "Bukti Pembayaran Salah"  ? 'selected' : ''}}>Bukti Pembayaran Salah</option>
                                   <option value="Pembelajaran Dapat Dimulai" {{$show->status == "Pembelajaran Dapat Dimulai"  ? 'selected' : ''}}>Pembelajaran Dapat Dimulai</option>                                 
                                   <option value="Menunggu Konfirmasi Admin" {{$show->status == "Menunggu Konfirmasi Admin"  ? 'selected' : ''}}>Menunggu Konfirmasi Admin</option>

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
 <!-- modal end -->