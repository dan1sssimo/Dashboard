<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{

    public function changePassword()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password create success!");
    }

    public function profile()
    {
        return view('profile.profile_edit');
    }

    public function addAvatar()
    {
        return view('profile.add_avatar');
    }

    public function storeAvatar(ProfileRequest $request)
    {
        $id = Auth::user()->id;
        if ($request->file('image')) {
            try {
                $avatarImage = User::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return redirect()->back()->with($ex);
            }
            $img = $avatarImage->image;
            if ($img != NULL)
                unlink('upload/' . $img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(250, 250)->save('upload/' . $name_gen);
            User::where('id', $id)->update(
                ['image' => $name_gen]
            );
            return redirect()->route('profile');
        }
    }

    public function deleteAvatar($id)
    {
        try {
            $avatarImage = User::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return redirect()->back()->with($ex);
        }
        $img = $avatarImage->image;
        if ($img != NULL)
            unlink('upload/' . $img);
        User::where('id', $id)->update(
            ['image' => NULL]
        );
        return redirect()->back();
    }

    public function editPassword(Request $request)
    {
        $new_pass = $request->input("new_pass");
        $conf_new_pass = $request->input("conf_new_pass");

        if($new_pass == $conf_new_pass)
        {
            \DB::table("users")->where("email", Auth::user()->email)->update([
                "password" => \Hash::make($conf_new_pass)
            ]);
        }

        else if($new_pass !== $conf_new_pass)
        {
            \Session::put('error', 'message');
        }

        return back();
    }
}
