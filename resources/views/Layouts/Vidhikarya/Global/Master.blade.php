<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"><title>@yield('title')</title>
<script type="text/javascript">
if (typeof Object.assign != 'function') {
  Object.assign = function(target) {
    'use strict';
    if (target == null) {
      throw new TypeError('Cannot convert undefined or null to object');
    }
    target = Object(target);
    for (var index = 1; index < arguments.length; index++) {
      var source = arguments[index];
      if (source != null) {
        for (var key in source) {
          if (Object.prototype.hasOwnProperty.call(source, key)) {
            target[key] = source[key];
          }
        }
      }
    }
    return target;
  };
}
</script>
<script type="text/javascript" src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/vue.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/vuetify.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/vuetify.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bulma.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/flexboxgrid.min.css') }}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script type="text/javascript" src="{{ URL::asset('js/semantic.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/semantic.css') }}">
</head><body>
@include('Layouts.Vidhikarya.Global.Header')

<div id="Main" style="min-height: 350px;">
@yield('content')
</div>

@include('Layouts.Vidhikarya.Global.Footer')

</body>
</html>