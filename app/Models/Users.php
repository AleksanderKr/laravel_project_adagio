<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user_addresses() {
        return $this->hasMany(User_addresses::class);
    }

    public function offers() {
        return $this->hasMany(Offers::class);
    }

    public function carts() {
        return $this->hasMany(Carts::class);
    }
}
