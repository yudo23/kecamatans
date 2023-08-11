<?php

namespace App\Models;

use App\Enums\AnnouncementEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use App\Traits\TrixRender;

class Announcement extends Model
{
    use HasFactory, Loggable,SoftDeletes,HasTrixRichText,TrixRender;
    protected $table = "announcements";
    protected $fillable = [
        'title',
        'slug',
        "fragment",
        'image',
        'date',
        'status',
        'announcement-trixFields',
    ];

    public function status()
    {
        $return = null;

        if($this->status == AnnouncementEnum::STATUS_TRUE){
            $return = (object) [
                'class' => 'success',
                'msg' => 'Active',
            ];
        }
        else{
            $return = (object) [
                'class' => 'warning',
                'msg' => 'Inactive',
            ];
        }

        return $return;
    }
}
