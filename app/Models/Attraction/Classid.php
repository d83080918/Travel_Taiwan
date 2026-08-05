<?php

namespace App\Models\Attraction;

use Illuminate\Database\Eloquent\Model;

class Classid extends Model
{
    public $timestamps = false;
    protected $table = "class";
    protected $primaryKey = 'id';
    protected $fillable = ["id", "className", "createTime"];
}
