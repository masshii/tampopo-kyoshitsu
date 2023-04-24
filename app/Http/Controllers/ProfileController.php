<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::all();
        $users = User::paginate(5);

        return view('profile.index', compact('users'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('profile.edit', compact('user'));
    }

    public function update(User $user, ProfileUpdateRequest $request)
    {
        $this->authorize('update', $user);

        $attr = [
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $request->avatar,
            'password' => $request->password
        ];

        if (!isset($attr['password'])) {
            unset($attr['password']);
        } else {
            $attr['password'] = Hash::make($attr['password']);
        }

        if (isset($attr['avatar'])) {
            if ($user->avatar !== 'default.jpg') {
                $oldavatar = 'public/avatar/' . $user->avatar;
                Storage::delete($oldavatar);
            }
            $name = request()->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His') . '_' . $name;
            request()->file('avatar')->storeAs('public/avatar', $avatar);
            $attr['avatar'] = $avatar;
        }

        $user->update($attr);

        return back()->with('message', '情報を更新しました');
    }

    public function destroy(User $user)
    {
        if ($user->avatar !== 'default.jpg') {
            $oldavatar = 'public/avatar/' . $user->avatar;
            Storage::delete($oldavatar);
        }

        $user->delete();

        return back()->with('message', 'ユーザーを削除しました');
    }
}
