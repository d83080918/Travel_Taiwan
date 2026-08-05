<?php

namespace App\Models\Collect;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    public $timestamps = false;
    protected $table = "member_attraction";
    protected $primaryKey = 'id';
    protected $fillable = ["id", "memberId", "attractionId", "createTime"];
}
