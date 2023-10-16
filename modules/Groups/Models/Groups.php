<?php

namespace Modules\Groups\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Groups extends Model
{
    use HasFactory;
   //protected $connection = 'wordpress';
   //protected $table = "";
   //protected $primaryKey = "id";
   protected $fillable = ['name','user_id'];
   public $timestamps = true;
   //const CREATED_AT ="created_at";
   //const UPDATED_AT ="updated_at";
   public function users(){
    return $this->hasMany(User::class);
   }
}
