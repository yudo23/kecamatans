<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inbox extends Model
{
    use HasFactory, Loggable,SoftDeletes;
    protected $table = "inboxes";
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];
}
