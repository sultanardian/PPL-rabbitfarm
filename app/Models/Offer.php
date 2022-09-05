<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['stock_id', 'order_id'];

    public function orders(){
    	return $this->hasMany('App\Models\Order');
    }

    public function stocks(){
    	return $this->hasOne('App\Models\Stock');
    }

    public function payments(){
    	return $this->hasOne('App\Models\Payment');
    }

    public function feedbacks(){
        return $this->hasMany('App\Models\Feedback');
    }
}
