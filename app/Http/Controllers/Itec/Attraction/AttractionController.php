<?php

namespace App\Http\Controllers\Itec\Attraction;

use App\Http\Controllers\Controller;
use App\Models\Attraction\Attraction;
use App\Models\Collect\Collect;
use App\Models\Member\Member;
use Illuminate\Http\Request;

class AttractionController extends Controller
{
    public function list()
    {
        $member = Member::where("id", session()->get("memberId"))->first();
        return view("attractions.attractions", compact("member"));
    }

    public function getList(Request $req)
    {
        $list = Attraction::getList($req);
        return response()->json($list);
    }

    public function getFavoriteList(Request $req)
    {
        $list = Attraction::getFavoriteList($req);
        return response()->json($list);
    }


    public function addfavorite(Request $req)
    {

        $memberId = session("memberId");
        $attractionId = $req->attractionId;

        $collect = Collect::where("memberId", $memberId)
            ->where("attractionId", $attractionId)
            ->first();

        if ($collect) {

            // 已收藏 → 取消收藏
            $collect->delete();

            return response()->json([
                "status" => "remove"
            ]);
        }

        // 尚未收藏 → 新增收藏
        Collect::create([
            "memberId" => $memberId,
            "attractionId" => $attractionId
        ]);

        return response()->json([
            "status" => "add"
        ]);
    }

    public function home()
    {
        $member = Member::where("id", session()->get("memberId"))->first();
        return view("attractions.home", compact("member"));
    }
}
