<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicine extends Model
{
    use HasFactory;

    public function catagory(){
        return $this->belongsTo(catagory::class,'cat_id');
    }
    public function units(){
        return $this->belongsTo(units::class,'unit_id');
    }
    public function manufacturer(){
        return $this->belongsTo(manufacturer::class,'mf_id');
    }
    public function stock(){
        return $this->hasMany(stock::class);
    }
}
