<?php

namespace Modules\Product\Models;

use Modules\Users\Models\Users;
use Modules\Product\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Customer extends Model
{
    use HasFactory;
    //protected $connection = 'wordpress';
    protected $table = 'nbw_wc_customer_lookup';
    protected $primaryKey = "customer_id"; 
    public $timestamps = true;
    const CREATED_AT ="date_registered";
    const UPDATED_AT ="date_last_active";
    protected $fillable = [
        "user_id",
        "username",
        "first_name",
        "last_name",
        "email",
        "country",
        "postcode",
        "city",
        "state"
    ];
    public function orders()
    {
        return $this->hasMany(Orders::class, 'customer_id');
    }
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'ID');
    }
}
