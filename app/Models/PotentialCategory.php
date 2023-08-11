<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PotentialCategory extends Model
{
    use HasFactory, Loggable,SoftDeletes;
    protected $table = "potential_categories";
    protected $fillable = [
        'name',
        'slug',
    ];
}
