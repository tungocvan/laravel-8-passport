<?php

namespace Modules\Users\Models;

use Modules\Groups\Models\Groups;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Model
{
    use HasFactory;
   //protected $connection = 'wordpress';
   //protected $table = "";
   //protected $primaryKey = "id";
   //protected $fillable = [];
   //protected $timestamps = true;
   //const CREATED_AT ="created_at";
   //const UPDATED_AT ="updated_at";  
   public function group(){        
    return $this->hasOne(Groups::class,'id','group_id');
}
}
