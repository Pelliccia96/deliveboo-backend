<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'description', 'ingredients', 'price', 'visibility', 'type'];
    public function restaurants() {
        return $this->hasMany(Restaurant::class);
    }
    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}