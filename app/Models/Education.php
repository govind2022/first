<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'country_id',
        'name',
        'status',        
        'createdby', 
        'updatedby' 
    ];    
}
