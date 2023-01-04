<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Site;
use App\Models\Warehouse;

class SubClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifierSubClient',
        'client_id',
        'warehouse_id',
        'site_id'
    ];

    public function Client(){
        return $this->hasOne('App\Models\Client', 'id','client_id');
    }

    public function Warehouse(){
        return $this->hasOne('App\Models\Warehouse', 'id','warehouse_id');
    }

    public function Site(){
        return $this->hasOne('App\Models\Site', 'id','site_id');
    }
}
