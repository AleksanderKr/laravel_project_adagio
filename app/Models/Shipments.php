<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function carts() {
        return $this->belongsTo(Carts::class);
    }
}
