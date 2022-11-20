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
    <link href="{{ asset('css/milligram.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auction.css') }}" rel="stylesheet">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer>
</script>
  </head>
  <body>
    <main>
      <header>
        <h1><a href="{{ url('/') }}">Online Auction</a></h1>
        <input type="text" placeholder="Search.." id="search-bar">
        @if (Auth::guard('web')->user())
        @php $id = Auth::guard('web')->user()->id @endphp
        <a class="button" href="{{ url('/logout') }}"> Logout </a> <a class="button" href="{{url('/user/'.$id)}}">{{ Auth::guard('web')->user()->name }}<a>
        @elseif (Auth::guard('manager')->user())
        @php $id = Auth::guard('manager')->user()->id @endphp
        <a class="button" href="{{ url('/logout') }}"> Logout </a> <a class="button" href="{{url('/manager/'.$id)}}">{{ Auth::guard('manager')->user()->name }}<a>
        @else
        <a class="button" href="{{ url('/login') }}"> Login </a> <span></span>
        @endif
      </header>
      <section id="content">
        @yield('content')

      </section>

        <footer id="footer">
        <div class="footer-container">
          <a class="faq" href="{{url('/faq')}}">FAQ</span>
          <a class="contact" href="{{url('/contact')}}">Contact US</span>
          <a class="about" href="{{url('/about')}}" >About</span>
          
        </div>
        <a class="copyright">© 2022 Online Auction</span>
      </footer>

      </section>
    </main>
  </body>
</html>
