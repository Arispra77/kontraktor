<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert/sweetalert.all.js') }}">
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Document</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/style.js') }}"></script>
</head>

<body>
    
    @if(session('error'))
    <div class="alert alert-danger" id="error-alert">
        {{ session('error') }}
    </div>
    
    <script>
        setTimeout(function() {
            document.getElementById('error-alert').style.display = 'none';
        }, 2000); // Menghilangkan pesan setelah 5 detik
    </script>
    @endif
    
 
<form method="POST" action='login/sesi' >
    @csrf
   
 
    <div class="wrapper bg-white">
        <div class="h3 text-center">Login Subkon</div>
       
        <form class="pt-3">
            <div class="form-group py-2">
                <div class="input-field"> <span class="far fa-user p-2"></span> <input type="text"id="nama_kary" name="nama_kary" placeholder="nama" required> </div>
            </div>
            @error('nama_kary')
            <div class="text-red-500 mt-2 text-sm">{{$message}}</div>
                           
            @enderror
            <div class="form-group py-1 pb-2">
                <div class="input-field"> <span class="fas fa-lock p-2"></span> 
                    <input id="password" type="password" name="password" required complete="current-password" placeholder="Password">

                        <span class="far fa-eye-slash" onclick="pass()" id="togglepassword" ></span>
                    </button> </div>
                 
            </div>
            @error('password')
            <div class="text-red-500 mt-2 text-sm">{{$message}}</div>
                           
            @enderror
    
           

           <div style=""> 
            <button class="btn btn-block text-center my-4" type="submit">Log in</button>
           </div>
        </form>
    </div>

</body>
</html>
      