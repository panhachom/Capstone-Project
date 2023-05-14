<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'description',
        'price',
        'capacity',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function tour_images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function tour_dates()
    {
        return $this->hasMany(TourDate::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }
}
