@php 
    $menuSidebar = getMenuSidebar();
@endphp
<div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <!-- scrollbar removed-->
    <div class="navbar-vertical-content">
        <ul class="navbar-nav flex-column" id="navbarVerticalNav">
            <li class="nav-item">
                <p class="navbar-vertical-label">Apps</p>        
                 @foreach ($menuSidebar as $key => $item)     
                    {!!render_menu_item($item)!!}
                 @endforeach                                        
            </li>
            <li class="nav-item">
                <p class="navbar-vertical-label">Pages</p>
                <div class="nav-item-wrapper"><a class="nav-link label-1" href="/env" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Starter</span></span></div>
                </a></div>
            </li>
        </ul>
    </div>
</div>
