<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangerousProperty extends Model
{
    use HasFactory;

    protected $fillable = ['code','name_sk','name_en', 'description_sk', 'description_en'];

}
