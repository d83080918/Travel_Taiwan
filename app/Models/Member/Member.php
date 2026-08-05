<?php

namespace App\Models\Member;

use App\Models\Attraction\Attraction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    public $timestamps = false;
    protected $table = "member";
    protected $primaryKey = 'id';
    protected $fillable = ["id", "userName", "email", "phone", "birthday", "pwd", "createTime"];
    protected $casts = ['birthday' => 'date'];

    public function checkemail(string $email)
    {
        $email = self::where("email", $email)->first();
        return $email;
    }

    public function checkpwd(string $pwd)
    {
        $pwd = self::where("pwd", $pwd)->first();
        return $pwd;
    }

    public function getMember(string $email, string $pwd)
    {
        $member = self::where("email", $email)->where("pwd", $pwd)->first();
        return $member;
    }

    public function attraction(): BelongsToMany
    {
        return $this->belongsToMany(Attraction::class, 'member_attraction', 'memberId', 'attractionId');
    }
}
