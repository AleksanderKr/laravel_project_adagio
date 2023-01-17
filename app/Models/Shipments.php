<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function carts() {
        return $this->belongsTo(Carts::class);
    }
}
