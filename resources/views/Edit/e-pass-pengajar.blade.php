<!-- Modal -->
<div class="modal fade " id="e-pass{{$prof->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>                      
                      <div class="modal-body">
                      <form  action="/update/pass/{{Auth::user()->email}}" method="POST">
                          @csrf
                          @method('PUT')      
                          <div class="input-group pt-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="nope"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="old_pass" autocomplete="off" placeholder="Password Lama" aria-describedby="nope" name="old_pass" required>
                        </div>  
                        <div class="input-group pt-2">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="nope"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="new_pass" autocomplete="off" placeholder="Password Baru" aria-describedby="nope" name="new_pass" required>
                        </div>                        
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