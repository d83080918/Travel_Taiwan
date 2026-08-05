<?php

namespace App\Models\Attraction;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    protected $table = "city";
    protected $primaryKey = 'id';
    protected $fillable = ["id", "cityName", "createTime"];
}
