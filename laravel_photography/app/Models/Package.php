<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';
    protected $primaryKey = 'package_id';

    protected $fillable = ['category_id', 'package_name', 'price', 'max_catelogues', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'package_id', 'package_id');
    }
}
