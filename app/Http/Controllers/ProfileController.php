<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $saya = Auth::user()->id;
        $user = User::where('id',$saya)->get();
        return view('profile.edit',compact('saya','user'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->name;
        $email = $request->email;
        $role = $request->role;
        $password =$request->password;
        $update = User::where('id',$id)
            ->update([
            'name' => $nama,
            'email' => $email,
            'role' => $role,
            'password' => Hash::make($request->get('password'))]);
        // auth()->user()->update($request->all());
        // auth()->user()->update(['password' => Hash::make($request->get('password'))]);
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function delete_user(Request $request){
        $id = $request->id;
        $delete = User::where('id',$id)->delete();

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
