<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offers;
use App\Models\User_addresses;
use App\Models\Carts;

class Users extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    public function user_addresses() {
        return $this->hasMany(User_addresses::class);
    }

    public function offers() {
        return $this->hasMany(Offers::class, 'id', 'seller_id');
    }

    public function carts() {
        return $this->hasMany(Carts::class);
    }
}
