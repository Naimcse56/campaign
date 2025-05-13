<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use FileUploadTrait;

    public function profile_setup()
    {
        return view('profiles.profile');
    }

    public function profile_update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'mobile' => 'required|max:14',
                'file' => 'nullable|file|mimes:jpg,png,jpeg|max:1000',
            ]);
            $user = auth()->user();
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            if ($request->hasFile('file')) {
                $user->avatar = $this->uploadFile($request->file, 'user-profile-image');
            }
            $user->save();
            
            return redirect()->back()->with('success', 'Updated Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function password_update(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'password' => 'required|string|min:6|confirmed',
            'current_password' => 'required|string|',
        ];
        $validator = Validator::make($request->except('_token'), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
        
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success', 'Password updated successfully.');
        } else {
            return back()->with('error', 'Current Password is not matching.');
        }
    }
}
