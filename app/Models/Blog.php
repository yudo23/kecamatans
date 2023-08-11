<?php

namespace App\Models;

use App\Enums\BlogEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use App\Traits\TrixRender;

class Blog extends Model
{
    use HasFactory, Loggable,SoftDeletes,HasTrixRichText,TrixRender;
    protected $table = "blogs";
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        "fragment",
        'image',
        'status',
        'blog-trixFields',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }

    public function status()
    {
        $return = null;

        if($this->status == BlogEnum::STATUS_TRUE){
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
