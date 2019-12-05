<div class="modal fade" id="enlargeImageModal{{$tampil->id_pertemuan}}" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Bukti Pertemuan Ke {{$loop->iteration}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                @if($tampil->bukti_temu == "") 
                    <img src="{!! asset('storage/img/image-not-found.jpg')!!}" style="width: 100%;">
                @else
                    <img src="{!! asset('storage/'.$tampil->bukti_temu)!!}" style="width: 100%;">
                @endif
            </div>
        </div>
    </div>
</div>

