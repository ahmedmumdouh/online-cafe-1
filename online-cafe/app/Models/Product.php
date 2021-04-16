<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image',

    ];

    public function orders()
    {
        return $this->belongsToMany(User::class)->withPivot(['quantity']);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
