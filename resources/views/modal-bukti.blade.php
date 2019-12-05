@php
$AuCheck = \App\User::join('roles','roles.id_role','=','users.id_role')                        
                              ->where('id',Auth::id())
                              ->first();
@endphp
@if($AuCheck->n_role == "client")
<!-- modal client start -->
<div class="modal fade" id="enlargeImageModal{{$terimas->id_trans}}" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
                   <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                           Bukti Transaksi {{$terimas->id_trans}}
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                       </div>
                       <div class="modal-body">
                          @if($terimas->bukti_trans == "") 
                         <img src="{!! asset('storage/img/image-not-found.jpg')!!}" style="width: 100%;">
                          @else
                          <img src="{!! asset('storage/'.$terimas->bukti_trans)!!}" style="width: 100%;">
                          @endif
                        </div>
                     </div>
                   </div>
               </div>
<!-- modal Client end -->

@else

<!-- modal Admin Start -->
<div class="modal fade" id="enlargeImageModal{{$show->id_trans}}" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
                   <div class="modal-dialog modal-lg" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                           Bukti Transaksi {{$show->id_trans}}
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                       </div>
                       <div class="modal-body">
                          @if($show->bukti_trans == "") 
                         <img src="{!! asset('storage/img/image-not-found.jpg')!!}" style="width: 100%;">
                          @else
                          <img src="{!! asset('storage/'.$show->bukti_trans)!!}" style="width: 100%;">
                          @endif
                        </div>
                     </div>
                   </div>
               </div>


<!-- modal Admin End -->

@endif