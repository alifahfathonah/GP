<!-- Modal -->
<div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Keahlian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                      <form class="" action="/create/dt-keahlian" method="post">
                          @csrf
                          <label for="n_keahlian">Nama Keahlian : </label>
                          <input type="text" class="form-control" placeholder="Nama Keahlian" name="n_keahlian" id="n_keahlian">
                      </div>
                      <div class="modal-footer">            
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                          <button type="submit" id="add-button" class="btn btn-success btn-sm">Tambahkan</button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
 <!-- modal end -->