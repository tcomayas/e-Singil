<?php

namespace App\Models;

use App\Models\Listing;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalDebt extends Model
{
    use HasFactory;

    protected $fillable = [
        'totaldebt'
    ];

    public function scopeFilter($query, array $filters){
        if($filters['sizes'] ?? false){
            $query->where('sizes', 'like', '%' . request('sizes') . '%');
        }

        if($filters['search'] ?? false){
            $query->where('product', 'like', '%' . request('search') . '%')
            ->orWhere('category', 'like', '%' . request('search').'%')
            ->orWhere('description', 'like', '%' . request('search').'%')
            ->orWhere('sizes', 'like', '%' . request('search').'%');
        }
    }

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

    public function payment(){
        return $this->hasMany(Payment::class);
    }
}
