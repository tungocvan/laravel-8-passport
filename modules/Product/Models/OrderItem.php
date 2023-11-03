<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Modules\Product\Models\Orders;

class OrderItem extends Model
{
    use HasFactory;
    // protected $connection = 'wordpress';
    protected $table = 'nbw_woocommerce_order_items';
    protected $primaryKey = "order_item_id"; 
    public $timestamps = false;
    protected $fillable = [
        'order_item_name',
        'order_item_type',
        'order_item_id',
        'order_id',                
    ];
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}