<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
<!-- Bootstrap JavaScript -->
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  --}}

    <link rel="stylesheet" href="{{ asset('css/realisasi.css') }}">
    <title>Document</title>
</head>

<body class="p-0 m-0 border-0 bd-example" id="realisasi">
    <div id="real">
<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
      <a class="navbar-brand" href="#">{{ old('nama_kary',Auth::user()->nama_kary) }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link " href="{{ route('profil') }}">Profil</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active"  href="{{ url('realisasi')}}">realisasi</a>
              </li>
             
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('logout') }}">Logout</a>
              </li>
          </ul>
      </div>
  </div>
</nav>

<!-- End Navbar -->
<div class="tabel" style="padding-top:50px;">
    
    <form action="{{ route('search') }}" method="GET">
        
            <label for="searchKapal">Cari Nama Kapal:</label>
            <input type="text" name="searchKapal" id="searchKapal" class="">
      
        <button type="submit" class="">Cari</button>
    </form>
    <br>
    
    <table class="table table-bordered">
        <thead>
            <tr>
              <th>No.</th>
                  <th>No SPK</th>
                  <th>No WBS</th>
                  <th>Kode Proyek</th>
                  <th>Nama Kapal</th>
                  <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr id="{{ $item->Id_Job_SPK }}">
              <td>{{ $loop->iteration }}</td> <!-- Ini adalah nomor urutan -->
            
              <td>{{ $item->NoSPK }}</td>
              <td>{{ $item->NoWBS }}</td>
              <td>{{ $item->Kode_Proyek }}</td>
              <td>{{ $item->{'Nama Kapal'} }}</td>
              <td> 

                  <a  href="" data-id="{{ $item->Id_Job_SPK }}" data-toggle="modal" data-target="#editModal{{ $item->Id_Job_SPK }}" class="btn btn-outline-info open-modal">Detail</a>

    
       
                 @include('realisasi.modal')
  
        </td>
       
            </tr>
            
            @endforeach
        </tbody>
    </table>
</div>
</div>
    {{ $data->links() }}
 
<script>
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $('.tambah-button').click(function(e){
e.preventDefault();
               // var ID = $('#kode').val();
// var ID = $(this).data('id');
//    var modalSelector = '#editModal' + ID;

var data1ID = $(this).data('data1-id'); // Ambil ID data1 dari atribut data-data1-id
var modalSelector = '#editModal' + data1ID;
console.log('Modal ID:', data1ID);

var Kode = $(modalSelector).find('#Kode').val();
var  realisasi_WP= $(modalSelector).find('#realisasi_WP').val();
var volume_Task = $(modalSelector).find('#volume_Task').val();
var Satuan = $(modalSelector).find('#Satuan').val();
var UnitPrice = $(modalSelector).find('#UnitPrice').val();
var Ttl_Price = $(modalSelector).find('#Ttl_Price').val();
//var nama = namaInput.val();
var form = $(modalSelector).find('#add');
var formDataId = form.data('data1-id');
// var nama = namaInput.val();
//console.log('Nama Input:', nama);
if (Kode === '') {
    Swal.fire({
        title: "Error",
        text: "masukkan kode.",
        icon: "error"
    });
   // $('#nama').focus();
    $('#editModal' + data1ID).find('#Kode').focus();
    return ; // Stop further execution if validation fails
}
if (realisasi_WP === '') {
    Swal.fire({
        title: "Error",
        text: "masukkan realisasi.",
        icon: "error"
    });
   // $('#nama').focus();
    $('#editModal' + data1ID).find('#realisasi_WP').focus();
    return ; // Stop further execution if validation fails
}
if (volume_Task === '') {
    Swal.fire({
        title: "Error",
        text: "masukkan volume.",
        icon: "error"
    });
   // $('#nama').focus();
    $('#editModal' + data1ID).find('#volume_Task').focus();
    return; // Stop further execution if validation fails
}
if (Satuan === '') {
    Swal.fire({
        title: "Error",
        text: "masukkan satuan.",
        icon: "error"
    });
   // $('#nama').focus();
    $('#editModal' + data1ID).find('#Satuan').focus();
    return ; // Stop further execution if validation fails
}

$.ajax({
    url: 'tambah-data-real/'+data1ID,
    method: 'POST',
    data: {
        'id' : formDataId,
        'Kode' : Kode,
        'realisasi_WP': realisasi_WP,
        'volume_Task': volume_Task,
        'Satuan': Satuan,
        'UnitPrice' : UnitPrice,
        'Ttl_Price' :Ttl_Price,
    },
    
    success: function(response) {
    if (response.success) {
        Swal.fire({
            title: "Success",
            text: response.message,
            icon: "success"
        }).then(function() {
            var table = $('#mytable' + data1ID + ' tbody');
            var KodeText = Kode;
            var realisasi_WPText = realisasi_WP;
            var volume_TaskText = volume_Task;
            var SatuanText = Satuan;
            var UnitPriceText = UnitPrice;
            var Ttl_PriceText = Ttl_Price;

            // Cek apakah teks realisasi_WP melebihi 150 karakter
            if (realisasi_WP.length > 150) {
                realisasi_WPText = realisasi_WP.substring(0, 150) + '...'; // Potong teks jika melebihi 150 karakter
            }
            var newRow = '<tr><td>' + KodeText + '</td><td class="truncate-text">' + realisasi_WPText + '</td><td>' + volume_TaskText + '</td><td>' + SatuanText + '</td><td>' + UnitPriceText + '</td><td>' + Ttl_PriceText + '</td></tr>';
            table.append(newRow);

            table.find('.tdk-ada-data').hide();

            // Hapus pesan "Tidak ada data" jika ada
            table.find('.tdk-ada-data').remove();
            // Tambahkan data ke dalam tabel
            //table.append('<tr><td>' + KodeText + '</td><td class="truncate-text">' + realisasi_WPText + '</td><td>' + volume_TaskText + '</td><td>' + SatuanText + '</td><td>' + UnitPriceText + '</td><td>' + Ttl_PriceText + '</td></tr>');

            console.log(modalSelector);
            $(modalSelector).find('.form-edit')[0].reset();
            $(modalSelector).modal('show');
        });
    }
},

    error:function(xhr){
        var errorMessage =  xhr.responseJSON.message;
        Swal.fire({
            title: "Error",
            text: errorMessage,
            icon: "error"
        });
    }
});
});
     
    

</script>
<script>
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
 $(document).ready(function(){
         
         $('body').on('click','.open-modal',function(e){
                e.preventDefault();
                var id = $(this).data('id');
                $('#editModal'+id).modal('show');
         })
        });
</script>
   


</body>
</html>