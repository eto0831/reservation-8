<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function store ()
    {
        $reservation = new Reservation();
        $reservation->user_id = $this->user_id;
        $reservation->shop_id = $this->shop_id;
        $reservation->reserve_date = $this->reserve_date;
        $reservation->reserve_time = $this->reserve_time;
        $reservation->guest_count = $this->guest_count;

        Reservation::create($reservation->toArray());

        return $reservation;
    }
}
