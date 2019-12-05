<!-- Modal -->
<div class="modal fade " id="e-keahlian{{$ahli->id_keahlian}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Keahlian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>                      
                      <div class="modal-body">
                      <form class="" action="/update/dt-keahlian/{{$ahli->id_keahlian}}" method="post">
                          @csrf
                          @method('put')
                        <label for="n_keahlian">Ubah <strong>{{$ahli->n_keahlian}}</strong>  menjadi :</label>
                        <input type="text" class="form-control" name="nm_keahlian" id="nm_keahlian" value="{{$ahli->n_keahlian}}">

                          
                      </div>
                      <div class="modal-footer">                        
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                          <button type="submit" id="add-button" class="btn btn-success btn-sm">Ubah</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
 <!-- modal end -->