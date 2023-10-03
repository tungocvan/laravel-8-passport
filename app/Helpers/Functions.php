<?php 
use Illuminate\Support\Str;
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
                <svg class='svg-inline--fa fa-caret-right' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='caret-right' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 512' data-fa-i2svg=''>
                    <path
                        fill='currentColor'
                        d='M118.6 105.4l128 127.1C252.9 239.6 256 247.8 256 255.1s-3.125 16.38-9.375 22.63l-128 127.1c-9.156 9.156-22.91 11.9-34.88 6.943S64 396.9 64 383.1V128c0-12.94 7.781-24.62 19.75-29.58S109.5 96.23 118.6 105.4z'
                    ></path>
                </svg>
                <!-- <span class='fas fa-caret-right'></span> Font Awesome fontawesome.com -->
            </div>
            <span class='nav-link-icon'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16px' height='16px' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'>
                    <circle cx='9' cy='21' r='1'></circle>
                    <circle cx='20' cy='21' r='1'></circle>
                    <path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path>
                </svg>
            </span>
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