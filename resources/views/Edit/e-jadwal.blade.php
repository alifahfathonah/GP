<!-- Modal -->
<div class="modal fade " id="e-jadwal{{$prof->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Atur Jadwal Ajar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>                 
                         
                      <div class="modal-body">
                      <form  action="/update/jadwal/{{$id_ajar}}" method="POST" autocomplete = "off">
                          @csrf  
                          <div class="container-fluid"> 
                          <div class="dlk-radio d-grid">
                          <label class="btn btn-info">                  
                          <input name="hari[]" class="form-control" type="checkbox" value="senin" @if($list_jadwal == NULL)  @elseif(str_contains('senin',$list_jadwal)) checked="checked"  @endif >
                            <i class="fa fa-check glyphicon glyphicon-ok"></i>
                            Senin
                          </label>
                          <label class="btn btn-info">
                          <input name="hari[]" class="form-control" type="checkbox" value="selasa" @if($list_jadwal == NULL)  @elseif(str_contains('selasa',$list_jadwal)) checked="checked"  @endif >
                              <i class="fa fa-check glyphicon glyphicon-ok"></i>
                              Selasa
                          </label>
                          <label class="btn btn-info">
                          <input name="hari[]" class="form-control" type="checkbox" value="rabu" @if($list_jadwal == NULL)  @elseif(str_contains('rabu',$list_jadwal)) checked="checked"  @endif >
                              <i class="fa  fa-check glyphicon glyphicon-ok"></i>
                              Rabu
                          </label>
                          <label class="btn btn-info">
                          <input name="hari[]" class="form-control" type="checkbox" value="kamis" @if($list_jadwal == NULL)  @elseif(str_contains('kamis',$list_jadwal)) checked="checked"  @endif >
                              <i class="fa fa-check glyphicon glyphicon-ok"></i>
                              Kamis
                          </label>
                          <label class="btn btn-info">
                          <input name="hari[]" class="form-control" type="checkbox" value="jumat" @if($list_jadwal == NULL)  @elseif(str_contains('jumat',$list_jadwal)) checked="checked"  @endif >
                              <i class="fa fa-check glyphicon glyphicon-ok"></i>
                              Jumat
                          </label>
                          <label class="btn btn-info">
                          <input name="hari[]" class="form-control" type="checkbox" value="sabtu" @if($list_jadwal == NULL)  @elseif(str_contains('sabtu',$list_jadwal)) checked="checked"  @endif >
                              <i class="fa fa-check glyphicon glyphicon-ok"></i>
                              Sabtu
                          </label>
                          <label class="btn btn-info">
                          <input name="hari[]" class="form-control" type="checkbox" value="minggu" @if($list_jadwal == NULL)  @elseif(str_contains('minggu',$list_jadwal)) checked="checked"  @endif >
                              <i class="fa fa-check glyphicon glyphicon-ok"></i>
                              Minggu
                          </label>
                          </div>
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