<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 Page Not Found - Vidhikarya</title>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/404/404.css') }}">
  <script type="text/javascript" src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
</head>
<body>
  <header>
    <a href="/" style="font-size: 30px;">Vidhikarya</a>
  </header>

  <div class="page-container page-container-responsive">
    <div class="row space-top-8 space-8 row-table">
        <div class="col-5 col-middle">
          <h1 class="text-jumbo text-ginormous">Oops!</h1>
          <h2>We can't seem to find the page you're looking for.</h2>
          <h6>Error code: 404</h6>
          <ul class="list-unstyled">
            <li>Here are some helpful links instead:</li>
            <li><a href="/">Home</a></li>
          </ul>
        </div>
        <div class="col-5 col-middle text-center">
          <img src="{{ URL::asset('images/404.gif') }}" width="313" height="428" alt="Girl has dropped her ice cream.">
        </div>
      </div>
    </div>
    
  </div>
</body>
</html>