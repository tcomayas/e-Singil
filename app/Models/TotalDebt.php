<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalDebt extends Model
{
    use HasFactory;

    protected $fillable = [
        'totaldebt'
    ];
    
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
