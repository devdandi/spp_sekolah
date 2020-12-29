<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <title>@yield('title')</title>
  </head>
  <body>
      <!-- Image and text -->
      <nav class="navbar navbar-dark bg-blue">
        <div class="valign">
        <div class="float-left">
        <a class="navbar-brand" href="{{ route('user.index') }}">
          <img src="https://getbootstrap.com//docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
          Bootstrap
        </a>
        </div>
        <div class="float-right">
        @if(Auth::guard('parent')->check())
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color:white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Akun Saya
          </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('user.show.update') }}">Pengaturan</a>
            <a class="dropdown-item" href="{{ route('user.transaction') }}">Transaksi</a>
              <!-- <a class="dropdown-item" href="#">Bantuan</a> -->
              <div class="dropdown-divider"></div>
                @if(Auth::guard('parent')->check())
                <form action="{{ route('logout') }}" method="post">@csrf <button onclick="return confirm('Keluar ? ') " class="btn btn-link text-blue">Keluar</button></form>
                @endif
              </div>
            </div>
          </div>
          @endif
        
        </div>
      </nav>
        @yield('content')


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>