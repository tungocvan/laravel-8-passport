@php 
    $sidebarPost = [
        ['id' => 1,'title' => 'Bài viết', 'parent_id' => 0, 'href' => '#post' ,'iconClass' => 'svg-inline--fa fa-caret-right'],
        ['id' => 2,'title' => 'Tất cả bài viết', 'parent_id' => 1, 'href' => '/post' ,'iconClass' => ''],
        ['id' => 3,'title' => 'Viết bài mới', 'parent_id' => 1, 'href' => '/post/add' ,'iconClass' => ''],
        ['id' => 4,'title' => 'Chuyên mục', 'parent_id' => 1, 'href' => '/post/category' ,'iconClass' => ''],
        ['id' => 5,'title' => 'thẻ', 'parent_id' => 1, 'href' => '/post/tags' ,'iconClass' => ''],
    ];
    $sidebarUser = [
        ['id' => 1,'title' => 'Thành viên', 'parent_id' => 0, 'href' => '#users' ,'iconClass' => 'svg-inline--fa fa-caret-right'],
        ['id' => 2,'title' => 'Tất cả người dùng', 'parent_id' => 1, 'href' => '/users' ,'iconClass' => ''],
        ['id' => 3,'title' => 'Thêm mới', 'parent_id' => 1, 'href' => '/users/add' ,'iconClass' => ''],
        ['id' => 4,'title' => 'Hồ sơ', 'parent_id' => 1, 'href' => '/users/profile' ,'iconClass' => ''],
        ['id' => 5,'title' => 'Phân quyền', 'parent_id' => 1, 'href' => '/users/permission' ,'iconClass' => ''],
    ];

    

@endphp
<div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <!-- scrollbar removed-->
    <div class="navbar-vertical-content">
        <ul class="navbar-nav flex-column" id="navbarVerticalNav">
            <li class="nav-item">
                <p class="navbar-vertical-label">Apps</p>                 
                 {!!render_menu_item($sidebarUser)!!}               
                 {!!render_menu_item($sidebarPost)!!}               
            </li>
            <li class="nav-item">
                <p class="navbar-vertical-label">Pages</p>
                <div class="nav-item-wrapper"><a class="nav-link active label-1" href="../pages/starter.html" role="button" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Starter</span></span></div>
                </a></div>
            </li>
        </ul>
    </div>
</div>
