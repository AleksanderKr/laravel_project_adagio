<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function offers() {
        return $this->hasMany(Offers::class);
    }

    public function carts() {
        return $this->belongsTo(Carts::class);
    }
}
