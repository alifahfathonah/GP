
<style type="text/css">

       @page {
           margin: 0px;
       }
       table{border-collapse:collapse}caption{padding-top:.75rem;padding-bottom:.75rem;color:#6c757d;text-align:left;caption-side:bottom}th{text-align:inherit}
       .table-striped tbody tr:nth-of-type(odd){background-color:rgba(0,0,0,.05)}
       body {
           margin: 0px;
       }
       * {
           font-family: Verdana, Arial, sans-serif;
       }
       a {
           color: #fff;
           text-decoration: none;
       }
       table {
           font-size: x-small;
       }
       tfoot tr td {
           font-weight: bold;
           font-size: x-small;
       }
       .text-light{color:#f8f9fa!important}
       .invoice table {
           margin: 15px;
       }
       .invoice h3 {
           margin-left: 15px;
       }
       .information {
           background-color:#e4833b!important;
           color: #FFF;
       }
       .information .logo {
           margin: 5px;
       }
       .information table {
           padding: 10px;
       }
       .thead-custom{
            background-color:#e4833b !important;
        }
   </style>
<body>
<div class="information">
    <table>
      <tr>
           <td align="center" style="width: 40%;">
               <h1>Laporan Transaksi</h1>
               <pre>
                 Tanggal : {{$filawal}} - {{$filakhir}}
              </pre>
           </td>
           <td></td>
           <td align="right" style="width: 40%;">

            <h3>GPrivat</h3>
            </td>
    </table>
  </div>
<table class="table table-striped"> 
    <thead>
        <tr class="thead-custom text-light" > 
            <th>Kode Transaksi</th>
            <th>Nama Klien</th>
            <th>Nama Pengajar</th>
            <th>Jumlah Pertemuan</th>
            <th>Harga Pertemuan</th>
            <th>Total Biaya</th>
            <th>Status</th>  
            <th>Tanggal Transaksi</th>          
        </tr>
        </thead>
        @foreach($filter as $show)
        <tr>
            <td>{{$show->id_trans}}</td>
            <td>{{$show->n_client}}</td>
            <td>{{$show->n_pengajar}}</td> 
            <td>{{$show->jml_temu}}</td> 
            <td>{{$show->hrg_temu}}</td> 
            <td>{{$show->grand_biaya}}</td> 
            <td>{{$show->status}}</td>     
            <td>{{date('d-m-Y', strtotime($show->created_at))}}</td>                  
        </tr>
            @endforeach
        
</table>
<p>Total Pemasukan : Rp.{{$filter->sum('grand_biaya')}} </p>
</body>