<?php

namespace App\Http\Controllers\Itec\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attraction\Attraction;
use App\Models\Member\Member;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminhome()
    {
        $member = Member::find(session()->get('memberId'));
        return view("admin.adminhome", compact("member"));
    }

    public function create()
    {
        $member = Member::find(session()->get('memberId'));

        return view("admin.create", compact("member"));
    }

    public function edit(Request $req)
    {
        $editattraction = Attraction::find($req->id);
        return view("admin.edit", compact("editattraction"));
    }

    public function store(Request $req)
    {
        $attraction = new Attraction();
        $attraction->attName = $req->attName;
        $attraction->attArea = $req->area;
        $attraction->cityId = $req->cityId;
        $attraction->classId = $req->classId;
        $attraction->attContent = $req->attContent;
        $attraction->save();

        $photo = $req->file("photo");
        if ($photo) {
            $fileName = $attraction->id . ".png";
            $photo->move(
                public_path("images"),
                $fileName
            );
            $attraction->attImg = $fileName;
            $attraction->save();
        }
    }

    public function delete(Request $req)
    {
        $deletedata = Attraction::find($req->id);
        if (!$deletedata) {
            return response()->json([
                'success' => false,
                'message' => '找不到資料'
            ], 404);
        }

        $path = public_path('images/' . $deletedata->attImg);
        if (File::exists($path)) {
            File::delete($path);
        }

        $deletedata->delete();

        return response()->json([
            'success' => true,
            'message' => '刪除成功'
        ]);
    }

    public function update(Request $req)
    {
        try {
            $attraction = Attraction::find($req->id);

            // 更新其他資料
            $attraction->attName = $req->attName;
            $attraction->attArea = $req->area;
            $attraction->cityId = $req->cityId;
            $attraction->classId = $req->classId;
            $attraction->attContent = $req->attContent;

            // 有上傳新圖片
            if ($req->hasFile('photo')) {


                $oldPath = public_path('images/' . $attraction->attImg);


                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }


                $file = $req->file('photo');


                $fileName = $attraction->id . '.png';

                // 移動到 public/images
                $file->move(public_path('images'), $fileName);

                // 更新資料庫圖片名稱
                $attraction->attImg = $fileName;
            }

            $attraction->save();

            return redirect('/admin/adminhome')->with('success', '修改成功');
        } catch (Exception $e) {

            return back()
                ->withInput()
                ->with('error', '修改失敗：' . $e->getMessage());
        }
    }

    public function logout(Request $req)
    {
        $req->Session()->flush();
        return response()->json(["status" => "success"]);
    }
}
