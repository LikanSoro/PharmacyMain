<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;

    public function medicine(){
        return $this->belongsTo(medicine::class,'med_id');
    }
}
