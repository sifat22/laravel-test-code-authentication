<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'User Logout Successfully', 
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }
//show login profile
    public function profile(){
        $id=Auth::user()->id;
        $adminData = User::find($id);

        return view('admins.admin_profile_view',compact('adminData'));
    }
//edit profile
    public function editprofile(){
        $id=Auth::user()->id;
        $editData = User::find($id);

        return view('admins.admin_profile_edit',compact('editData'));
    }

//update profile

//$data database name and $request code name

public function Storeprofile(Request $request){
    $id = Auth::user()->id;
    $data = User::find($id);
    $data->name = $request->name;
    $data->email = $request->email;
    $data->username = $request->username;

    if ($request->file('profile_image')) {
       $file = $request->file('profile_image');

       $filename = date('YmdHi').$file->getClientOriginalName();
       $file->move(public_path('upload_image/admin_image'),$filename);
       $data['profile_image'] = $filename;
    }
    $data->save();

    //toaster message
    $notification = array(
        'message' => 'Admin Profile Updated Successfully', 
        'alert-type' => 'info'
    );
    return redirect()->route('admin.profile')->with($notification);

}

//Change password page

public function ChangePassword(){
    return view('admins.change_password');
}

//update password
public function UpdatePassword(Request $request){
    $validateData = $request->validate([
        'oldpassword' => 'required',
        'newpassword' => 'required',
        'comfirm_password' => 'required | same:newpassword',

    ]);

    $hashPassword = Auth::user()->password;
    if (Hash::check($request->oldpassword,$hashPassword)){
        $users = User::find(Auth::id());
        $users->password = bcrypt($request->newpassword);
        $users->save();

        session()->flash('message','successfully updated password');
        return redirect()->back();

    }else{
        session()->flash('message','Old Password doesnot match');
        return redirect()->back();

    }
}






}
