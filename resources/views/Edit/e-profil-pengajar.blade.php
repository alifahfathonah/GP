
@yield('formpengajar')
<form action="/update/profil/{{Auth::user()->email}}" method="post">
@csrf
@method('PUT')
    @foreach($datas as $data)
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="fullname"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="fullname" name="nama" placeholder="Nama Lengkap" value="{{ $data->name }}" aria-describedby="inputGroupPrepend2" required>
                </div>
                <div class="input-group pt-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="norek"><i class="far fa-credit-card"></i></span>
                    </div>
                    <input type="text" class="form-control" id="norek" placeholder="Nomor Rekening" aria-describedby="norek" name="norek" value="{{ $data->norek }}" required>
                </div>
               
                         
<!-- START INPUT KOTA -->

<script>
                   
            $(function()
            {
                $("#kota").autocomplete({
                minLength: 3,
                source: function(request, response) {
                    $.getJSON("{{ route('Profil.Cari') }}", {
                        term: request.term,
                       
                    },  function(data) {                    
                        response(data);
                    
                    });
                },
                focus: function(event, ui) {
                    event.preventDefault();
                    
                    $('#kotaList').val(ui.item.label);
                },
            
                select: function(event, ui) {
                    event.preventDefault();
                    $('#kota').val(ui.item.value);   
                },         
                });
            });
        </script>
         <div class="input-group pt-2">
                    <div class="input-group-prepend ui-widget">
                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                    </div>
                    <input type="text" name="kota" id="kota" placeholder="Lokasi Kerja Yang Diinginkan" value="{{ $data->area }}" class="form-control">
                        <div id="kotaList" class="dropdown-item">        
                        </div>
                        <!-- END INPUT KOTA -->  
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="alamat"><i class="fas fa-graduation-cap"></i></span>
                </div>
                    <select name="keahlian" id="keahlian" class="form-control">
                        @foreach($keahlian as $ahli)
                            <option  value="{{ $ahli->id_keahlian }}" {{$data->id_keahlian == $ahli->id_keahlian  ? 'selected' : ''}}> {{$ahli->n_keahlian}} </option>
                        @endforeach
                    </select>
            </div>
            <div class="input-group pt-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="norek"><i class="fas fa-sticky-note"></i></span>
                </div>
                    <textarea name="keterangan" placeholder="Keterangan Tentang Keahlian Atau Diri Anda" class="form-control" id="" >{{ $ahli->keterangan }}</textarea>
            </div>
            
          
        </div>
    
        </div>
    
        </div>
@endforeach
        
      <button class="btn btn-success pt-2 w-100 mt-5"> Ubah Profil</button>
        </form> 
