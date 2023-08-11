<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Province extends Model
{
    use HasFactory, Loggable;
    protected $table = "indonesia_provinces";
    protected $fillable = [
        'code',
        'name',
        'meta',
        'alias',
        'logo',
        'governor_name',
    ];

    public function cities()
    {
        return $this->hasMany(City::class, 'province_code', 'code');
    }
}
