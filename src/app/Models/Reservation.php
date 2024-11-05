<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Shop;



class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shop_id', 'reserve_date', 'reserve_time', 'guest_count', 'is_visited'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function review()
    {
        return $this->hasOneOrMany(Review::class);
    }

}
