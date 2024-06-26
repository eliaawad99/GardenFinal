<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'image' , 'species' , 'watering' , 'date_planted' , 'soil_type' , 'drainage' , 'fertilizer' , 'sunlight' , 'humidity' , 'notes'];
}
