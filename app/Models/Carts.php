<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\User;
use App\Models\Notification;

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

    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
