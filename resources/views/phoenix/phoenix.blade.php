@extends('layouts.master')
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
@endsection
@section('jsHead')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@parent
@endsection
@section('main')
    @include('phoenix.admin') 
@endsection
@section('jsFooter')        
        <script src="/phoenix/vendors/popper/popper.min.js"></script>
        <script src="/phoenix/vendors/bootstrap/bootstrap.min.js"></script>   
        <script src="/phoenix/vendors/fontawesome/all.min.js"></script> 
        <script src="/phoenix/assets/js/app.js"></script>
@endsection