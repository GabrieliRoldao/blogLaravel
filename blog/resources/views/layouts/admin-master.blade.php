<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Área do administrador</title>
        <link rel="stylesheet"  href="{{URL::asset('src/css/admin.css')}}" />
        @yield('styles')
    </head>
    
    <body>
        @include('includes.admin-header')
        @yield('content')
        
        <script type="text/javascript">
            var baseUrl = "{{URL::to('/')}}";
        </script>
        @yield('scripts')
    </body>    
</html>