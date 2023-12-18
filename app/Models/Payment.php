<?php

namespace App\Models;

use App\Models\User;
use App\Models\TotalDebt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment',
        'name',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function total_debt(){
        return $this->hasMany(TotalDebt::class);
    }
}
