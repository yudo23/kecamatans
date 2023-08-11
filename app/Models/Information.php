<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use App\Traits\TrixRender;

class Information extends Model
{
    use HasFactory, Loggable,SoftDeletes,HasTrixRichText,TrixRender;
    protected $table = "informations";
    protected $fillable = [
        'slug',
        'village_code',
        'information-trixFields',
    ];

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_code', 'code');
    }

    public function potentials()
    {
        return $this->hasMany(Potential::class, 'village_code', 'village_code');
    }
}
