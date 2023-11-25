<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\User;

class Carts extends Model
{
    // use HasFactory;
    protected $table = 'carts';
    // protected $fillable = [
    //     'user_id',
    //     'listing_id',
    //     'quantity',
    //     'amount'
    // ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function listings(){
        return $this->hasMany(Listing::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
