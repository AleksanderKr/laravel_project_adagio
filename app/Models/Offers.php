<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Orders;
use App\Models\ProductOpinions;

class Offers extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function users() {
        return $this->belongsTo(Users::class, 'id', 'seller_id');
    }

    public function orders() {
        return $this->belongsTo(Orders::class);
    }

    public function opinions() {
        return $this->hasMany(ProductOpinions::class);
    }
}
