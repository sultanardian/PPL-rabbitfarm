<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['fisher_id', 'stock', 'total_stock', 'price', 'date', 'img'];

    public function fishers(){
    	return $this->belongsTo('App\Models\Fisher');
    }
}
