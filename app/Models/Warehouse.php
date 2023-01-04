<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\countries;
use App\Models\cities;
use App\Models\departaments;
use App\Models\Site;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'identifierWarehouse',
        'country_id',
        'city_id',
        'departament_id',
        'site_id',
        'direction',
    ];

    public function Country(){
        return $this->hasOne('App\Models\countries', 'id','country_id');
    }
    public function City(){
        return $this->hasOne('App\Models\cities', 'id','city_id');
    }
    public function Departament(){
        return $this->hasOne('App\Models\departaments', 'id','departament_id');
    }
    public function Site(){
        return $this->hasOne('App\Models\Site', 'id','site_id');
    }
}
