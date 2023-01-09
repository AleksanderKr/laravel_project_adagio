<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddresses extends Model
{
    use HasFactory;

    public $timestamps = false;

    #protected $fillable = ['address_id'];
    public function users() {
        return $this->belongsTo(Users::class);
    }
    
}
