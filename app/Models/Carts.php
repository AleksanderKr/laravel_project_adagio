<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function shipments() {
        return $this->hasMany(Shipments::class);
    }
    
    public function payments() {
        return $this->hasMany(Payments::class);
    }
    
    public function orders() {
        return $this->hasMany(Orders::class);
    }
    
    public function users() {
        return $this->belongsTo(Users::class);
    }
}
