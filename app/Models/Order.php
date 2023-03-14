<?php

namespace App\Models;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'cus_id','ship_id', 'pay_id', 'total','status'];
    public function customer(){
        return $this->belongsTo(Customer::class,'cus_id');
    }
    public function shipping(){
        return $this->belongsTo(Shipping::class,'ship_id');
    }
    public function payment(){
        return $this->belongsTo(Payment::class,'pay_id');
    }
}
