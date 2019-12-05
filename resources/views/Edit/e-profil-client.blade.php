
<form action="/update/profil/{{ Auth::user()->email }}" method="post" autocomplete="off">
@csrf
@method('put')
    @foreach($clients as $client)
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="fullname"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" autocomplete="off" id="fullname" value="{{ $client->name }}" name="nama" placeholder="Nama Lengkap" aria-describedby="inputGroupPrepend2" required>
                </div>
                <div class="input-group pt-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="nope"><i class="fas fa-mobile-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nope" autocomplete="off" value="{{ $client->nope }}" placeholder="Nomor Telepon" aria-describedby="nope" name="nope" required>
                </div>
               
                         
<!-- START INPUT KOTA -->

<script>
                    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

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
                    <input type="text" name="kota" id="kota" value="{{ $client->kota }}" placeholder="Kabupaten / Kota, Kecamatan" class="form-control">
                        <div id="kotaList" class="dropdown-item">        
                        </div>
                        <!-- END INPUT KOTA -->  
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text" id="alamat"><i class="fas fa-home"></i></span>
                </div>
                <TEXtarea class="form-control" id="alamat" placeholder="Alamat" aria-describedby="alamat" name="alamat" required>{{ $client->alamat }}</TEXtarea>
            </div>
@endforeach         
            
          
        </div>
    
        </div>
    
        </div>
        
      <button class="btn btn-success pt-2 w-100 mt-5"> Ubah Profil</button>
        </form> 
