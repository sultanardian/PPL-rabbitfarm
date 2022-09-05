<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisher extends Model
{
    use HasFactory;

    protected $fillable = ['fisher_name', 'fisher_address'];

    public function stocks(){
    	return $this->hasMany('App\Models\Stock');
    }
}
