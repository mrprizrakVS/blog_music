<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function edit($id)
    {
        if (\Auth::check() && \Auth::user()->id == $id) {
            $user = User::findOrFail($id);
            return view('user.edit', compact('user'));
        } else {
            return redirect(route('user.edit', \Auth::user()->id));
        }
    }

    public function update($id, Request $request)
    {
        if (\Auth::check() && \Auth::user()->id == $id) {
            $user = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string|min:6|max:100',
                'new_password' => 'required|string|min:6|max:100|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect(route('user.edit', \Auth::user()->id))
                    ->with('status', 'danger')
                    ->with('message', 'Профіль не змінено, перевірте коректність паролю, потрібно, щоб співпадав!');
            }

            if (Hash::check($request->current_password, $user->password)) {
                User::findOrFail($id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => !empty($request->new_password) ? Hash::make($request->new_password) : $user->password,
                ]);
                return redirect(route('user.edit', \Auth::user()->id))
                    ->with('status', 'success')
                    ->with('message', 'Профіль змінено');
            }else{
                return redirect(route('user.edit', \Auth::user()->id))
                    ->with('status', 'danger')
                    ->with('message', 'Паролі не співпадають!');
            }
        } else {
            return redirect(route('user.edit', \Auth::user()->id));
        }
}
}
