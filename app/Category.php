<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $fillable = [
        'id', 'category_name',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    use SoftDeletes;
}
