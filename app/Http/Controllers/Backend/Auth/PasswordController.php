<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\BackendController as Controller;

class PasswordController extends Controller
{

    /**
     * 修改密码
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
        // dump($request->input('old_password'));
        // $this->validate($request, $this->rules(), $this->validationErrorMessages());
        // $user = $this->guard()->user();
        // dump($user);
        // dump($user->password);
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'old_password' => 'required|string|different:password',
            'password' => 'required|string|confirmed|min:6',
        ];
    }


    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
