<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;


    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('product', 'like', '%' . request('search') . '%')
            ->orWhere('category', 'like', '%' . request('search').'%')
            ->orWhere('description', 'like', '%' . request('search').'%');
        }
    }

    // Relationship To User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //Relationship to Cart
    public function cart(){
        return $this->belongsTo(Carts::class);
    }

    public function sale(){
        return $this->belongsTo(sales::class);
    }
}
