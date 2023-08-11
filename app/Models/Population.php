<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Population extends Model
{
    use HasFactory, Loggable,SoftDeletes;
    protected $table = "populations";
    protected $fillable = [
        'village_code',
        'total',
    ];

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_code', 'code');
    }
}
