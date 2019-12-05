<!-- Modal -->
<div class="modal fade " id="c-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                      <div class="container">
                        <form class="" action="/create/dt-admin" method="post">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="nama"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" aria-describedby="inputGroupPrepend2" required>
                            </div>
                            <div class="input-group pt-1 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="email"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email " aria-describedby="inputGroupPrepend2" required>
                            </div>
                            <div class="input-group pt-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="password"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password " aria-describedby="inputGroupPrepend2" required>
                            </div>
                            <div class="input-group pt-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="password_confirmation"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" aria-describedby="inputGroupPrepend2" required>
                            </div>
                            <div class="input-group pt-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="password_confirmation"><i class="fas fa-briefcase"></i></span>
                                </div>
                                <select name="role" id="role" class="form-control">
                                    @foreach($role_list as $role)
                                    <option value="{{ $role->id_role }}"> {{$role->n_role}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">            
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="add-button" class="btn btn-success btn-sm">Tambahkan</button>
                        </form>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
 <!-- modal end -->