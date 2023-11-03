<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\OrderItem;

class Product extends Model
{
    use HasFactory;
    //protected $connection = 'wordpress';
    protected $table = 'nbw_posts';
    protected $primaryKey = "ID";   
    protected $fillable = [
        'post_title',
        'post_status',
        'post_type',
        'post_author',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }   
}
