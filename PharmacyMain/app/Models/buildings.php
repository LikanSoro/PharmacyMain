<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class building extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
    ];

    public function GetFormattedDateAttribute(){
        return $this->created_at->format('d-m-y');
    }

    protected $appends = ['formatted_date'];
}
