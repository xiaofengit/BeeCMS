<?php
namespace App\Http\Controllers\Backend\Role;

use App\Http\Controllers\BackendController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * 数据列表
     */
    public function index(Request $request)
    {
        // dump($request->perpage);
        // exit;
        $admins = Admin::paginate($request->perpage?:10, ['*'], 'page', $request->page?:1);
        return $admins;
    }

    /**
     * 保存
     */
    public function store(Request $request)
    {
        // 验证数据
        $this->validate($request, $this->storeRules());

        $admin = Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_active' => $request->input('is_active') ? 1 : 0
        ]);

        return $admin ? response(['message' => '新增成功'], 200) :  response(['message' => '新增失败'], 422);
    }

    /**
     * 信息
     */
    public function show(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        return $admin;
    }

    /**
     * update
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // 验证
        $validateData = $request->only(['name','email','password','is_active']);
        if (empty($validateData['password'])) {
            unset($validateData['password']);
        }

        $validator = Validator::make($validateData, [
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:admins,email,'.$admin->id,
            'password' => 'sometimes|min:6',
            'is_active' => 'sometimes|boolean',
        ])->validate();

        // 保存
        $admin->name = $validateData['name'];
        $admin->email = $validateData['email'];
        $admin->is_active = $validateData['is_active'] ? 1 : 0;
        if (!empty($validateData['password'])) {
            $admin->password = Hash::make($validateData['password']);
        }
        $admin->save();
        return $admin;
    }

    /**
     * destroy
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if($admin->is_super == 1) {
            return response(['message' => '不能删除超级管理员'], 422);
        }

        $res = $admin->delete();
        return $res ? response(['message' => '删除成功'], 200) : response(['message' => '删除失败'], 422);
    }

    /**
     * 规则
     */
    protected function storeRules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'is_active' => 'required|boolean'
        ];
    }
}
