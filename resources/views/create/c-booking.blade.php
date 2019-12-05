<!-- Modal -->
<div class="modal fade " id="c-booking{{$lists->id_pengajar}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pesan Jasa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                      <form class="" action="/create/pesan/{{$lists->id_pengajar}}" method="post">
                          @csrf
                          <label for="n_keahlian">Jumlah Pertemuan : </label>
                          <select name="" id="" class="form-control">
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                          </select>
                      </div>
                      <div class="modal-footer">            
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                          <button type="submit" id="add-button" class="btn btn-success btn-sm">Pesan</button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
 <!-- modal end -->