<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function orders() {
        return $this->belongsTo(Orders::class);
    }

    public function opinions() {
        return $this->hasMany(ProductOpinions::class);
    }
}
