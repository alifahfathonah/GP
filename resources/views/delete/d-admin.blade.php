<!-- Modal -->
<div class="modal fade " id="d-admin{{$adm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                      <label for="">Hapus <strong>{{$adm->email}}</strong> dari database? </label>
                      </div>
                      <div class="modal-footer">
                        <form class="" action="/delete/dt-admin/{{$adm->id}}" method="post">
                          @csrf
                          @method('delete')
                          
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                          <button type="submit" id="add-button" class="btn btn-danger btn-sm">Hapus</button>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>
 <!-- modal end -->