<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'city_id',
        'country_id',
        'name',
        'status',        
        'createdby', 
        'updatedby' 
    ];    
}
