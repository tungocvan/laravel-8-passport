@php          
  $title = $title ?? 'admin';  
@endphp
<main class="main" id="top">
    <div class="container-fluid px-0" data-layout="container">
        
        <nav class="navbar navbar-vertical navbar-expand-lg navbar-sidebar">            
            @include('Admin::phoenix.parts.sidebar')
            <div class="navbar-vertical-footer"><button class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-0"></span><span class="uil uil-arrow-from-right fs-0"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button></div>
        </nav>
        <nav class="navbar navbar-top navbar-expand" id="navbarDefault">
            @include('Admin::phoenix.parts.header')
        </nav>
        <div class="content" style="margin-left: 239px">           
            @include("Admin::phoenix.parts.$title-content")
            <footer class="footer position-absolute">
                <div class="row g-0 justify-content-between align-items-center h-100">
                  <div class="col-12 col-sm-auto text-center">
                    <p class="mb-0 mt-2 mt-sm-0 text-900">Website with HAMADA<span class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none">2023 ©<a class="mx-1" href="https://demo.tungocvan.com">Từ Ngọc Vân</a></p>
                  </div>
                  <div class="col-12 col-sm-auto text-center">
                    <p class="mb-0 text-600">v1.10.0</p>
                  </div>
                </div>
            </footer>
        </div>
        
    </div>
<main>
