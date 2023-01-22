<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;   
use App\Models\Offers;
use App\Models\User_addresses;
use App\Models\Carts;


class Users extends Model
{
    use HasFactory;
    use Searchable;

    public $timestamps = false;
    protected $guarded = ['id'];
    protected $hidden = ['password'];

    public function user_addresses() {
        return $this->hasMany(User_addresses::class);
    }

    public function offers() {
        return $this->hasMany(Offers::class, 'id', 'seller_id');
    }

    public function carts() {
        return $this->hasMany(Carts::class);
    }

    public function toSearchableArray() {
        return [
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ];
    }
}
