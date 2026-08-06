<?php

namespace App\Http\Controllers\Itec\Member;

use App\Http\Controllers\Controller;
use App\Models\Member\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function login()
    {
        return view("member.login");
    }

    public function dologin(Request $req)
    {
        $email = $req->email;
        $pwd = $req->pwd;
        $member = (new Member())->getMember($email, $pwd);
        if (empty($member)) {
            return back()->withInput()->withErrors(["err" => "Y"]);
        } elseif ($member->id == 1) {
            session()->put("memberId", $member->id);
            session()->put("email", $member->email);
            session()->put("admin", $member->id);
            $url = session("admin_redirect", "/admin/adminhome");
            session()->forget("admin_redirect");

            return redirect($url);
        } else {
            session()->put("memberId", $member->id);
            session()->put("email", $member->email);

            if (!empty($req->redirect)) {

                return redirect($req->redirect);
            }

            return redirect("/member/home");
        }
    }

    public function register()
    {
        return view("member.register");
    }

    public function checkemail(Request $req)
    {
        $email = (new Member())->checkemail($req->email);
        $msg = "";
        if (empty($email)) {
            $msg = "N";
        } else {
            $msg = "Y";
        }
        return response()->json(["msg" => $msg]);
    }

    public function checkpwd(Request $req)
    {
        $pwd = (new Member())->checkpwd($req->pwd);
        $msg = "";
        if (empty($pwd)) {
            $msg = "N";
        } else {
            $msg = "Y";
        }
        return response()->json(["msg" => $msg]);
    }

    public function store(Request $req)
    {
        $member = new Member();
        $member->userName = $req->userName;
        $member->email = $req->email;
        $member->phone = $req->phone;
        $member->birthday = $req->birthday;
        $member->pwd = $req->pwd;
        $member->save();

        session()->put("memberId", $member->id);
        session()->put("email", $member->email);

        return redirect("/member/home");
    }

    public function home()
    {
        $member = Member::find(session()->get("memberId"));


        return view("member.home", compact("member"));
    }

    public function update(Request $req)
    {
        $member = Member::find(session()->get("memberId"));
        $member->userName = $req->userName;
        $member->email = $req->email;
        $member->phone = $req->phone;
        $member->birthday = $req->birthday;
        $member->save();

        session()->put("memberId", $member->id);
        session()->put("email", $member->email);

        return redirect("/member/home");
    }

    public function updatepwd(Request $req)
    {
        $member = Member::find(session()->get("memberId"));
        $member->pwd = $req->newpwd1;
        $member->save();

        return redirect("/member/home")->with("message", "密碼更新成功");
    }

    public function logout(Request $req)
    {
        $req->session()->flush();

        return response()->json([
            "status" => "success"
        ]);
    }
}
