<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\OrderItem;
use Modules\Product\Models\Customer;

class Orders extends Model
{
    use HasFactory;
    protected $connection = 'wordpress';
    protected $table = 'nbw_wc_order_stats';
    protected $primaryKey = "order_id"; 
    public $timestamps = true;
    const CREATED_AT ="date_created";
    const UPDATED_AT ="date_created_gmt";

    public function items()
    {
        //$result = Orders::find(2563); // order_id
        return $this->hasMany(OrderItem::class, 'order_id');
    }    
    public function customer()
    {
        //$result = Orders::find(2563); // order_id
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
