<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <title></title>

    
   
</head>
<body class="p-0 m-0 border-0 bd-example" style="background-image: url('{{ asset('gambar/latar.jpg') }}'); background-size: 100% 100%; background-position: center; background-attachment: fixed;">
 
{{-- <body class="p-0 m-0 border-0 bd-example m-0 border-0"> --}}
  
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
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profil')}}">Profil</a>
                    </li>
                    
                    
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('realisasi')}}">realisasi</a>
                </li>
           
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->


<div class="container mt-5">
 
    <div class="tes">
        <h1>Username: {{ old('nama_kary',Auth::user()->nama_kary) }}</h1>
        <h3>Nama PT: {{ old('nama_kary1',Auth::user()->nama_kary1) }}</h3>
    </div>
                  
        
</div>
<style>
   .container {

  /* margin-top: 50px; */
 
}
.tes{
    background: rgba(0, 0, 0, 0.9);
    margin-top:9%;
    padding-top: 20px;
  padding-bottom: 20px;
  padding-left: 5%;
  padding-right: 20%;
  border-radius: 10px;
    color: #ffffff;
  letter-spacing: 2px;
}

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .card-text {
        font-size: 18px;
    }
</style> 
</body>
</html>
