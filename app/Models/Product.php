<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bahans() {
        return $this->belongsToMany(Bahan::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
