<?php

namespace App\Models;

use App\Models\User;
use App\Models\Carts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'message'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->hasMany(Carts::class);
    }
    public function cart(){
        return $this->belongsTo(Carts::class);
    }
}
