<!-- Modal -->
<div class="modal fade " id="c-booking{{$all->id_pengajar}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog border-primary modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pesan Jasa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                      <form class="" action="/create/pesan/{{ $all->id_pengajar }}" method="post">
                          @csrf
                          <label for="n_keahlian">Jumlah Pertemuan : </label>
                          <input type="hidden" name="harga" id="harga" value="{{ $all->gaji }}">
                          <select name="temu" id="temu" onChange="update_amounts()" class="form-control">
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                          </select>
                          <b>          
                            <p class="small text-right text-dark pt-3">Total yang harus dibayarkan : <span class="total" id="total"></span></p>
                            <input type="hidden" id="total_biaya" class="total" name="total">
                          </b>
                            <textarea name="note" id="note" class="form-control" cols="30" rows="3" placeholder="Catatan, contoh : mengajar jam 9 pagi"></textarea>
                      </div>
                      
                      <script>
                      $(document).ready(function(){
                        update_amounts();
                        $('#temu').change(function() {
                            update_amounts();
                        });
                        });

                        function update_amounts()
                          {
                              var sum = 0;
                              $('.modal-body').each(function() {
                                  var temu = $(this).find('option:selected').val();
                                  var harga = $(this).find('#harga').val();
                                  var total = (temu*harga)
                                  sum+=total;
                                  console.log(total)
                                  $(this).find('#total').text(''+total);
                                  $(this).find('#total_biaya').val(''+total);
                              });
                              //just update the total to sum    
                          }
                                                
                      </script>
                      <div class="modal-footer">            
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                          <button type="submit" id="add-button" class="btn btn-success btn-sm">Pesan</button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
 <!-- modal end -->