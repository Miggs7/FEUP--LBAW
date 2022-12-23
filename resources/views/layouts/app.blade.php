<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!--CSS to Overide-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <script type="text/javascript">
    </script>
    <script type="text/javascript" src={{ asset('js/bootstrap.bundle.js') }} defer> </script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer> </script>
    @stack('pageJS')

    
  </head>
  <body>  

      <header class="p-3 text-white">
        <div class="container">
          <div class="d-flex flex-wrap">
    
            <ul class="nav col col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href={{url('/')}} id="logo" class="nav-link px-2">Online Auction</a></li>
            </ul>
    
            <form class="col col-lg-auto me-lg-auto mb-3 mb-lg-0 me-lg-3">
              <input type="search" id="search-bar" class="form-control form-control-dark" onkeyup="search()" placeholder="Search..." aria-label="Search">
            </form>

            <div class="text-end">
              @if(Auth::guard('web')->user())
              @php $id = Auth::guard('web')->user()->id @endphp
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{Auth::guard('web')->user()->name}}
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item text-black" href={{url('/user/'.$id)}}>Profile</a></li>
                <li><a class="dropdown-item text-black" href={{url('/auction/new')}}>New Auction</a></li>
                <li><a class="dropdown-item text-black" href={{url('/watchList/'.$id)}}>Watchlist</a></li>
                <li><a class="dropdown-item text-black" href="{{url('/auctionlist/'.$id)}}">Auctionlist</a></li>
                <li><a class="dropdown-item text-black" href="#">Inbox</a></li>
                <li><a class="dropdown-item text-black" href="{{url('/logout')}}">Logout</a></li>
              </ul>
            </div>
              @elseif (Auth::guard('manager')->user())
              @php $id = Auth::guard('manager')->user()->id @endphp
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{Auth::guard('manager')->user()->name}}
                </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item text-black" href={{url('/manager/'.$id)}}>Profile</a></li>
                <li><a class="dropdown-item text-black" href="{{url('/logout')}}">Logout</a></li>
              </ul>
              </div>

              @else 
              <a href={{url('/login')}}>
              <button type="button" class="btn me-2">Login</button>
              </a>
              @endif
            </div>
          </div>
        </div>
      </header>
      
      <ul class="nav justify-content-center" id="categories">
        @for($i=1; $i <= 7 ; $i++)
          @php
          $category = App\Http\Controllers\CategoryController::getCategoryById($i);
          @endphp
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/auctionCategory/'.$i) }}" class="category"> {{$category['type']}} </a>
          </li>
          @endfor
      </ul>
      
      @yield('content')

      <footer class="py-3" >
        <ul class="nav justify-content-center pb-3 mb-3">
          <li class="nav-item"><a href="{{url('/faq')}}" class="nav-link px-2">FAQs</a></li>
          <li class="nav-item"><a href="{{url('/contact')}}" class="nav-link px-2">Contacts</a></li>
          <li class="nav-item"><a href="{{url('/about')}}" class="nav-link px-2">About Us</a></li>
        </ul>
        <p class="text-center text-white">© 2022 LBAW 132, Inc</p>
      </footer>
  </body>
</html>
