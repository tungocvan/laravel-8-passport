<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Post\Models\PostMeta;
class Post extends Model
{
   use HasFactory;
   //protected $connection = 'wordpress';
   protected $table = "nbw_posts";
   protected $primaryKey = "ID";
   //protected $fillable = [];
   public $timestamps = true;
   const CREATED_AT ="post_date";
   const UPDATED_AT ="post_date_gmt";

   public function postMeta(){
        return $this->hasMany(PostMeta::class);
   }
}
 