<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'cus_id','ship_id', 'pay_id', 'total','status'];
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
