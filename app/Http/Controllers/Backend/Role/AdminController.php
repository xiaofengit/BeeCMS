<?php
namespace App\Http\Controllers\Backend\Role;

use App\Http\Controllers\BackendController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AdminController extends Controller
{
    /**
     * 数据列表
     */
    public function index()
    {
        $admins = Admin::paginate();
        return $admins;
    }

    /**
     * 创建
     */
    public function store(Request $request)
    {
        // 验证数据
        $this->validate($request, $this->rules());

        $admin = Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_active' => $request->input('is_active') ? 1 : 0,
            'is_actives' => $request->input('is_active') ? 1 : 0
        ]);

        return $admin ? response(['message' => '新增成功'], 200) :  response(['message' => '新增失败'], 422);
    }

    /**
     * 信息
     */
    public function show(Request $request, $id)
    {
        var_dump($id);
    }

    /**
     * 规则
     */
    protected function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'is_active' => 'required'
        ];
    }
}
