<!DOCTYPE html>
<html lang="en">
  <head>
      @include('partials._head')
      @include('partials._javascripts')
  </head>
  <body>
   @include('partials._nav')
   <div class="container">
        @include('partials._message') 
        @yield('content')     
   </div><!--End of container-->

  </body>  
</html>