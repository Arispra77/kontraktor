<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.js"></script>
    
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <title></title>
</head>

<body class="p-0 m-0 border-0 bd-example" style="background-image: url('{{ asset('gambar/latar.jpg') }}'); background-size: 100% 100%; background-position: center; background-attachment: fixed;">
 
    <!-- Alert untuk pesan sukses atau error -->
<div class="alert alert-success" style="display:none;"></div>
<div class="alert alert-danger" style="display:none;"></div>

    @include('sweetalert::alert')
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
                    <a class="nav-link active" href="{{ route('profil') }}">Profil</a>
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

<div class="container mt-4">
    <h4>Username: {{ old('nama_kary', Auth::user()->nama_kary) }}</h4>
    <p>Nama PT: {{ old('nama_kary1', Auth::user()->nama_kary1) }}</p>
</div>

<div class="container mt-4" >
    <!-- Button to trigger the password change form -->
    <button id="editPasswordButton" class="btn btn-primary">Edit Password</button>
</div>
   {{-- modal --}}
    <div class="modal fade" id="passwordChangeForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Password</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
<form method="POST" action="{{ route('passwordd') }}" id="reset" >
    @method('POST')
    @csrf

    <div class="form-group row">
        <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Password lama') }}</label>

        <div class="col-md-6">
            <input id="current_password" type="password" class="form-control" name="current_password" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password baru') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password baru') }}</label>

        <div class="col-md-6">
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary" id="submit-btn">{{ __('Save') }}</button>
            <button type="button" class="btn btn-secondary" id="close-btn">{{ __('Close') }}</button>
        </div>
    </div>
</form>

            </div>
          
          </div>
        </div>
      </div>

<!-- Password Change Form -->
{{-- 
<form method="POST" action="{{ route('passwordd') }}" id="passwordChangeForm" style="display:none;">
    @method('POST')
    @csrf

    <div class="form-group row">
        <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Password lama') }}</label>

        <div class="col-md-6">
            <input id="current_password" type="password" class="form-control" name="current_password" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password baru') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password baru') }}</label>

        <div class="col-md-6">
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary" id="submit-btn">{{ __('Save') }}</button>
            <button type="button" class="btn btn-secondary" id="close-btn">{{ __('Close') }}</button>
        </div>
    </div>
</form> --}}


<script>
    $(document).ready(function() {
    // Tombol "Edit Password"
    $('#editPasswordButton').on('click', function(e) {
           e.preventDefault();
        // Munculkan form
        $('#passwordChangeForm').modal('show');
       // $('#current_password').focus();
    });

    // Tombol "Close"
    $('#close-btn').on('click', function() {
        // Sembunyikan form
        $('#passwordChangeForm').modal('hide');
    });

    // Submit form
    $('#passwordChangeForm').on('submit', function(e) {
        e.preventDefault();

        var current_password = $('#current_password').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();

        // Validasi input
        if (current_password === '') {
            Swal.fire({
                title: "Error",
                text: "Please enter your current password.",
                icon: "error"
            });
            $('#current_password').focus();
            return false;
        }
        if (password === '') {
            Swal.fire({
                title: "Error",
                text: "Please enter your new password.",
                icon: "error"
            });
            $('#password').focus();
            return false;
        }
        if (password_confirmation === '') {
            Swal.fire({
                title: "Error",
                text: "Please confirm your new password.",
                icon: "error"
            });
            $('#password_confirmation').focus();
            return false;
        }
        if (password !== password_confirmation) {
            Swal.fire({
                title: "Error",
                text: "password baru dan confirmasi password tidak sama.",
                icon: "error"
            });
            $('#password_confirmation').focus();
            return false;
        }

        // Kirim request untuk mengubah password
        $.ajax({
            type: 'POST',
            url: '{{ route('passwordd') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'current_password': current_password,
                'password': password,
                'password_confirmation': password_confirmation,
            },
            // beforeSend: function() {
            //     // Menampilkan loading spinner
            //     $('#submit-btn').html('<i class="fa fa-spinner fa-spin"></i> Saving...');
            // },
            success: function(response) {
                // Menampilkan pesan sukses menggunakan SweetAlert2
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success"
                }).then(function() {
                    // Setelah pengguna menekan OK pada SweetAlert2, reset form dan sembunyikan
                    $('#reset')[0].reset();
                    $('#passwordChangeForm').modal('show');
                });
            },
            error: function(xhr, textStatus, error) {
                // Menampilkan pesan error menggunakan SweetAlert2
                var errorMessage =  xhr.responseJSON.message;
                Swal.fire({
                    title: "Error",
                    text: errorMessage,
                    icon: "error"
                });
                $('#submit-btn').html('Save');
            }
        });
    });

    // Menampilkan form jika terdapat error
    @if ($errors->any())
        $('#editPasswordButton').click();
    @endif
});

</script>



</body>
</html>
