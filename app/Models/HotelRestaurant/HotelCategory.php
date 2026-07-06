<?php

namespace App\Models\HotelRestaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    use HasFactory;

    protected $table = "hotel_categories";

    public function subCategory()
    {
        return $this->hasMany(HotelSubCategory::class, 'hotel_category_id', 'id');
    }
}