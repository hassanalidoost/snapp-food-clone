<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' , 'raw_materials' , 'price' , 'discount_id' , 'is_party' , 'restaurant_id'];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(FoodCategory::class);
    }

    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class , 'imageable');
    }
}