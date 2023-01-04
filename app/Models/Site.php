<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifierSite',
        'nameSite',
        'client_id'
    ];

    public function ClientQ(){
        return $this->hasOne('App\Models\Client', 'id','client_id');
    }
}
    
