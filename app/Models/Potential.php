<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use App\Traits\TrixRender;

class Potential extends Model
{
    use HasFactory, Loggable,SoftDeletes,HasTrixRichText,TrixRender;
    protected $table = "potentials";
    protected $fillable = [
        'category_id',
        'village_code',
        'name',
        'slug',
        'image',
        'potential-trixFields',
    ];

    public function category()
    {
        return $this->belongsTo(PotentialCategory::class, 'category_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_code', 'code');
    }
}
