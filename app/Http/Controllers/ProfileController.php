<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(){
        return view("profile.edit");
    }
    public function update(Request $request){
        $request->validate([
            "photo"=>"required|mimes:jpg,png,jpeg",
        ]);
        $file = $request->file("photo");
        $newFileName = uniqid()."_profile.".$file->getClientOriginalExtension();
        $dir = "/public/profile/";
        // $file->move("store/",$newFileName);
        Storage::putFileAs($dir,$file,$newFileName);
        $user = User::find(Auth::id());
        $user->photo=$newFileName;
        $user->update();
        // $arr = scandir(public_path("/storage"));
        // return view("profile.edit",compact('arr'));
        return redirect()->route("profile.edit");
    }
}
