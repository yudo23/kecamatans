<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, Loggable,SoftDeletes;
    protected $table = "files";
    protected $fillable = [
        'name',
        'file',
    ];
}
