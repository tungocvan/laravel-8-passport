<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />           
        @section('meta')                              
        @show 
        <!-- Favicon icon-->
        <title>@yield('title')</title>
        <!-- Libs CSS -->        
        @section('cssHead')                              
        @show  
        @section('jsHead')                              
        @show          
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
              @section('jsFooter')   
              @show              
    </body>
</html>
  