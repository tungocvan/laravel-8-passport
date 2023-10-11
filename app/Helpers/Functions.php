<?php 
use Illuminate\Support\Str;
use Modules\Groups\Models\Groups;
use Illuminate\Support\Facades\Mail;
// use File;
function send_mail($options){        
    $to = $options['to'] ?? 'tungocvan@gmail.com';    
    $cc = $options['cc'] ?? '';    
    $content  = $options['content'] ?? '<h3>This is test mail<h3>';
    $subject = $options['subject'] ?? 'Email send from HAMADA';    
    // nếu không phải là môi trường host cpanel
    if(env('DB_HOST') !== 'localhost') {
        file_put_contents(base_path().'/send_mail.txt',$to.'-'.$subject."\n",FILE_APPEND);      
        return true;  
    }else{     
        try {
        Mail::send([], [], function ($message) use ($to,$cc,$content, $subject) {
            $message->to($to);
            $cc && $message->cc($cc);
            $message->subject($subject);            
            $message->setBody($content, 'text/html');        
        });
        file_put_contents(base_path().'/send_mail.txt',$to.'-'.$subject."\n",FILE_APPEND);    
        return true;
        } catch (\Exception $e) {
            // Xử lý lỗi khi gửi email
            file_put_contents(base_path().'/error.txt','không gửi được đến email: '.$to.'-'.$subject."\n",FILE_APPEND); 
            return false;
        }        
    }   
}

// Hàm cấu hình .env

function setEnv($newEnvData,$keyDelete=null){ 
    
    if(count($newEnvData) <=0) return false;
    $envFilePath = base_path('.env');
    // Đọc nội dung của file .env hiện có
    $envContent = file_get_contents($envFilePath);
    if($keyDelete === null){                
        foreach ($newEnvData as $key => $value) {
            // Tạo chuỗi ghi đè cho mỗi biến môi trường
            $overrideString = "{$key}={$value}";
            // Kiểm tra xem biến môi trường đã tồn tại trong file .env hay chưa
            if (strpos($envContent, "{$key}=") !== false) {
                // Nếu tồn tại, thay thế giá trị cũ bằng giá trị mới
                $envContent = preg_replace("/^{$key}=.*/m", $overrideString, $envContent);
            } else {
                // Nếu không tồn tại, thêm mới vào cuối file .env
                $envContent .= PHP_EOL . $overrideString;
            }
        }
    }else{        
        $envContent = preg_replace("/^{$keyDelete}=.*/m", '', $envContent);
    }
    
    // Ghi đè nội dung mới vào file .env
    file_put_contents($envFilePath, $envContent);
    return true;

}

function getFileToArray($file){     
    if (file_exists($file)) {
        $envContent = file_get_contents($file);
        $envLines = preg_split('/\r\n|\r|\n/', $envContent);
        return $envLines;
    }
    return null;
}
function getEnvToArray($file){     
    $envLines = getFileToArray($file);
    if (count($envLines) > 0) {
        $envArray = [];
        foreach ($envLines as $line) {
            $key = Str::before($line,'=');
            $value = Str::after($line,'=');
            $envArray[$key] = $value;
        }    
        return $envArray;
    }
    return null;
}

function isRole($dataArr,$moduleName,$role='view')
{
    if(!empty($dataArr[$moduleName])){
        $roleArr = $dataArr[$moduleName];
        if(!empty($roleArr) && in_array($role,$roleArr)){
            return true;
        }
    }
    return false;
}

function checkPermissions($user,$moduleName,$role)
{
        
        $roleJson = $user->group->permissions;        
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson,true);            
            $check = isRole($roleArr,$moduleName,$role);
            return $check;
        }
        
    return false;
}

function has_child($data,$id){
    foreach ($data as $v) {
        if($v['parent_id'] == $id){
            return true;
        }
    }
    return false;
}

function render_menu($options){

    $data = $options['data'] ?? [];
    $parent_id = $options['parent_id'] ?? 0;
    $level = $options['level'] ?? 0;
    $idMenu = $options['id'] ?? 'main_menu';
    $classMenu = $options['class'] ?? '';
    if($classMenu !== '') $classMenu="class='$classMenu'";
    if($level == 0) $result = "<ul id='$idMenu' $classMenu  >";
    else $result = "<ul id='sub-menu'>";

    foreach ($data as $key => $v) {
        if($v['parent_id'] == $parent_id){            
            $result .= "<li>";
            $result .= "<a href='{$v['url']}'>{$v['name']}</a>";
            if(has_child($data,$v['id'])){
                unset($data[$key]); 
                $result .= render_menu(['data' => $data,'parent_id' => $v['id'],'level' => $level+1]);
            }
            $result .= "</li>";
        }
    }
    $result .= "</ul>";
    return $result;
}

function render_menu_item($options=null){        
    $titleActive = request()->getRequestUri();    
    $titleModule = $options[0]['title'];
    $iconClass = $options[0]['iconClass'];
    $hrefModule = Str::after($options[0]['href'], '#') ;
    $moduleActive = Str::after($titleActive, '/') ;
    //dd($hrefModule.'-'.$moduleActive);
    $idMoudle = $hrefModule;
    $item = '';
    $show = '';
    $collapsed = 'collapsed';
    $collapsedUl = 'collapse';
    if(Str::contains($moduleActive,$hrefModule)) {
        $collapsed = '';
        $collapsedUl = '';
        $show ='show';
    }else{
        $show = '';
        $collapsed = 'collapsed';
        $collapsedUl = 'collapse';
    }
    foreach ($options as $key => $value) {

        if($value['parent_id'] !== 0){
            $title = $value['title'];
            $href = $value['href'];
            $active = '' ;
            if($titleActive === $href) $active = 'active' ;
            $item .="
            <li class='nav-item'>                                
                <a class='nav-link  $active' href='$href'>
                    <span class='nav-link-text'>$title</span>
                </a>
            </li>
            ";
        }
    }
    return "
        <div class='nav-item-wrapper'>
            <a class='nav-link dropdown-indicator label-1 $collapsed' href='/#$idMoudle' role='button' data-bs-toggle='collapse' aria-expanded='false' aria-controls='e-commerce'>
                <div class='d-flex align-items-center'>
                    <div class='dropdown-indicator-icon'>
                        <span class='nav-link-icon text-danger fas fa-caret-right' style='height: 16px; width: 16px;color:#3e456b!important'></span>                           
                    </div>                                 
                    <span class='nav-link-icon text-danger $iconClass' style='height: 16px; width: 16px;color:#3e456b!important'></span>
                    <span class='nav-link-text'>$titleModule</span>
                </div>
            </a>
            <div class='parent-wrapper label-1'>
                <ul class='nav parent collapsed $collapsedUl $show' data-bs-parent='#navbarVerticalCollapse' id='$idMoudle' style=''>
                    <li class='collapsed-nav-item-title d-none'>$titleModule</li>                            
                    $item                 
                </ul>
            </div>
        </div>
         ";
}

function getUrlView($titleUrl,$data=[])
    {
        if($titleUrl!==''){
            $title = Str::before($titleUrl, '/');
            $action = Str::after($titleUrl, '/');        
            $module = ucfirst($title); 
            return view("$module::phoenix.phoenix",compact('title','module','action','data')); 
        }
        return '';        
    }

function getMenuSidebar()
{
    return [
        [
            ['id' => 1,'title' => 'Bài viết', 'parent_id' => 0, 'href' => '#post' ,'iconClass' => 'far fa-list-alt'],
            ['id' => 2,'title' => 'Tất cả bài viết', 'parent_id' => 1, 'href' => '/post' ,'iconClass' => ''],
            ['id' => 3,'title' => 'Viết bài mới', 'parent_id' => 1, 'href' => '/post/add' ,'iconClass' => ''],
            ['id' => 4,'title' => 'Chuyên mục', 'parent_id' => 1, 'href' => '/post/category' ,'iconClass' => ''],
            ['id' => 5,'title' => 'Thẻ', 'parent_id' => 1, 'href' => '/post/tags' ,'iconClass' => ''],
        ],
        [
            ['id' => 1,'title' => 'Sản phẩm', 'parent_id' => 0, 'href' => '#product' ,'iconClass' => 'fab fa-first-order'],
            ['id' => 2,'title' => 'Tất cả sản phẩm', 'parent_id' => 1, 'href' => '/product' ,'iconClass' => ''],
            ['id' => 3,'title' => 'Thêm mới', 'parent_id' => 1, 'href' => '/product/add' ,'iconClass' => ''],
            ['id' => 4,'title' => 'Danh mục', 'parent_id' => 1, 'href' => '/product/category' ,'iconClass' => ''],
            ['id' => 5,'title' => 'Từ khóa', 'parent_id' => 1, 'href' => '/product/tags' ,'iconClass' => ''],
            ['id' => 6,'title' => 'Các thuộc tính', 'parent_id' => 1, 'href' => '/product/attributes' ,'iconClass' => ''],
        ],
        [
            ['id' => 1,'title' => 'Thành viên', 'parent_id' => 0, 'href' => '#users' ,'iconClass' => 'far fa-user-circle'],
            ['id' => 2,'title' => 'Tất cả người dùng', 'parent_id' => 1, 'href' => '/users' ,'iconClass' => ''],
            ['id' => 3,'title' => 'Thêm mới', 'parent_id' => 1, 'href' => '/users/add' ,'iconClass' => ''],
            ['id' => 4,'title' => 'Hồ sơ', 'parent_id' => 1, 'href' => '/users/profile' ,'iconClass' => ''],
            ['id' => 5,'title' => 'Nhóm người dùng', 'parent_id' => 1, 'href' => '/groups/users' ,'iconClass' => ''],
            ['id' => 6,'title' => 'Danh sách Modules', 'parent_id' => 1, 'href' => '/modules/users' ,'iconClass' => ''],
        ],
    ];
}

function getGroupName($groupId){
    $groups = Groups::find($groupId);    
    return $groups->name;
}