<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';
    protected $primaryKey = 'gallery_id';

    protected $fillable = ['catalogue_id', 'category_id', 'image_title', 'image', 'description', 'status'];

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class, 'catalogue_id', 'catalogue_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
