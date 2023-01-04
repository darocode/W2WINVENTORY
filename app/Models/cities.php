<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\countries;

class cities extends Model
{
    use HasFactory;

    protected $fillable = [
        'nameCity',
        'country_id'
    ];

    public function Country(){
        return $this->hasOne('App\Models\countries', 'id','country_id');
    }
}
