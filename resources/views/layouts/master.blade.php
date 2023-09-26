<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />   
        @yield('meta')   
        <!-- Favicon icon-->
        <title>@yield('title')</title>
        <!-- Libs CSS -->
        @yield('cssHead')
        @yield('jsHead')
    </head>
    <body>        
              @section('header')                              
              @show             
              @section('main')                              
              @show 
              @section('footer')                  
              @show             
              @section('modal')                  
              @show              
              @yield('jsFooter')                 
    </body>
</html>
  