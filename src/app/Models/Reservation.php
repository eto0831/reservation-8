<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'shop_id', 'reserve_date', 'reserve_time', 'guest_count', 'is_visited'];
}
