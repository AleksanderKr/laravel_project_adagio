<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOpinions extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function offers() {
        return $this->belongsTo(Offers::class);
    }
}
