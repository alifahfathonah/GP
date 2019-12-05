<div class="modal fade" id="enlargeImageModalUpah{{$tampil->id_pertemuan}}" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Bukti Upah Pertemuan Ke {{$loop->iteration}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                @if($tampil->bukti_upah == "") 
                    <img src="{!! asset('storage/img/image-not-found.jpg')!!}" style="width: 100%;">
                @else
                    <img src="{!! asset('storage/'.$tampil->bukti_upah)!!}" style="width: 100%;">
                @endif
            </div>
        </div>
    </div>
</div>

