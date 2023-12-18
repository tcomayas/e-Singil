<?php

namespace App\Models;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;

    public function listings(){
        return $this->hasMany(Listing::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
