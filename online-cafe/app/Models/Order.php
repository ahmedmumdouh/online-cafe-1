<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\User;
use App\Models\Room;

class Order extends Model
{
    use HasFactory;
    public function  products()
    {

        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity']);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->belognsTo(Room::class);
    }
}
