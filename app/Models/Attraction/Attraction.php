<?php

namespace App\Models\Attraction;

use App\Models\Member\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attraction extends Model
{
    public $timestamps = false;
    protected $table = "attraction";
    protected $primaryKey = 'id';
    protected $fillable = ["id", "attName", "cityId", "classId", "attArea", "attContent", "attImg", "createTime"];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, "cityId");
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Classid::class, "classId");
    }

    public function collect(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_attraction', 'attractionId', 'memberId');
    }

    public static function getList($req)
    {
        $memberId = $req->memberId;

        $sql = self::with(["city", "class",]);

        if (!empty($memberId)) {

            $sql->with([
                "collect" => function ($query) use ($memberId) {
                    $query->where(
                        "memberId",
                        $memberId
                    );
                }
            ]);
        }

        $keyword = $req->keyword;

        if (!empty($req->keyword)) {
            $keyword = $req->keyword;

            $sql->where(function ($q) use ($keyword) {
                $q->where("attName", "like", "%{$keyword}%")
                    ->orWhere("attContent", "like", "%{$keyword}%");
            });
        }


        if (!empty($req->area)) {
            $sql->where("attArea", $req->area);
        }


        if (!empty($req->city)) {
            $sql->where("cityID", $req->city);
        }


        if (!empty($req->classid)) {
            $sql->where("classID", $req->classid);
        }

        $list = $sql->paginate(6);

        foreach ($list as $item) {
            if (!empty($item->attImg)) {
                $item->attImg = asset("images/" . $item->attImg);
            } else {
                $item->attImg = asset("images/no-image.png");
            }
            if (!empty($memberId)) {
                $item->isFavorite = $item->collect->count() > 0;
            } else {
                $item->isFavorite = false;
            }
            // 不需要把collect資料回傳給前端
            unset($item->collect);
        }
        return $list;
    }

    public static function getFavoriteList($req)
    {
        $memberId = $req->memberId;

        $sql = self::with(["city", "class",])
            ->whereHas("collect", function ($query) use ($memberId) {
                $query->where('memberId', $memberId);
            });

        $keyword = $req->keyword;

        if (!empty($req->keyword)) {
            $keyword = $req->keyword;

            $sql->where(function ($q) use ($keyword) {
                $q->where("attName", "like", "%{$keyword}%")
                    ->orWhere("attContent", "like", "%{$keyword}%");
            });
        }


        if (!empty($req->area)) {
            $sql->where("attArea", $req->area);
        }


        if (!empty($req->city)) {
            $sql->where("cityID", $req->city);
        }


        if (!empty($req->classid)) {
            $sql->where("classID", $req->classid);
        }

        $list = $sql->paginate(6);

        foreach ($list as $item) {
            if (!empty($item->attImg)) {
                $item->attImg = asset("images/" . $item->attImg);
            } else {
                $item->attImg = asset("images/no-image.png");
            }
            if (!empty($memberId)) {
                $item->isFavorite = $item->collect->count() > 0;
            } else {
                $item->isFavorite = false;
            }
            // 不需要把collect資料回傳給前端
            unset($item->collect);
        }
        return $list;
    }
}
