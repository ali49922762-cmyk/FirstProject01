<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Hotel extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'address',
        'city',
        'description',
        'category_id'
    ];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile(); 
    }
}
