<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\User;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class );
    }
}
