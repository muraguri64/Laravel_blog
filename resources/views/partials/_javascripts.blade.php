	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script('js/jquery.min.js', array("type" => "text/javascript")) }} 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   {{ HTML::script('js/bootstrap.min.js', array("type" => "text/javascript")) }}       
   {{ HTML::script('js/bootbox.min.js', array("type" => "text/javascript")) }}
    @yield('scripts')