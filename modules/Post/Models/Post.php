<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
 