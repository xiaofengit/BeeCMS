<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BackendController as Controller;

class PasswordController extends Controller
{

    /**
     * 修改密码
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        $request->user()->fill([
            'password' => Hash::make($request->input('password'))
        ]);

        $res = $request->user()->save();

        return $res ? response(['message' => '更新成功'], 200) : response(['message' => '更新失败'], 422);

        // var_dump($request->user());

        // $this->validateReset($request);

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
            'old_password' => [
                'required',
                'string',
                'different:password',
                function($attribute, $value, $fail) {
                    $password = $this->guard()->user()->getAttribute('password');
                    if (!Hash::check($value, $password)) {
                        return $fail('旧密码不匹配');
                    }
                }
            ],
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
