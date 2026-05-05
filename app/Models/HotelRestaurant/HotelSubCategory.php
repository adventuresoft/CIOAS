<?php

namespace App\Models\HotelRestaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelSubCategory extends Model
{
    use HasFactory;

    protected $table = "hotel_sub_categories";


    public function category()
    {
        return $this->belongsTo(HotelCategory::class, 'hotel_category_id', 'id');
    }
}