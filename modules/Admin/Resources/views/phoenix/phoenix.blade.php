@php          
  $title = $title ?? 'admin';  
  $Module = ucfirst($title);
@endphp
@extends('Admin::layouts.master')
@section('cssHead')  
        <link rel="stylesheet" href="/phoenix/assets/css/line.css" />
        <link
        href="/phoenix/assets/css/theme-rtl.min.css"
        type="text/css"
        rel="stylesheet"
        id="style-rtl"
        />
        <link
        href="/phoenix/assets/css/theme.min.css"
        type="text/css"
        rel="stylesheet"
        id="style-default"
        />
        <link href="/phoenix/assets/css/app.css" rel="stylesheet" />        
        <script src="/phoenix/assets/js/config.js"></script>
@endsection
@section('main')
    @include("$Module::phoenix.$title",compact('title')) 
@endsection
@section('jsFooter')        
        <script src="/phoenix/vendors/popper/popper.min.js"></script>
        <script src="/phoenix/vendors/bootstrap/bootstrap.min.js"></script>   
        <script src="/phoenix/vendors/fontawesome/all.min.js"></script>                 
        <script type="module" src="/phoenix/src/js/theme/navbar-vertical.js"></script>
        <script src="/phoenix/vendors/prism/prism.js"></script>        
        <script src="/phoenix/assets/js/app.js"></script>
@endsection