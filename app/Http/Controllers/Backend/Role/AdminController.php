<?php
namespace App\Http\Controllers\Backend\Role;

use App\Http\Controllers\BackendController as Controller;
use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    /**
     * 数据列表
     */
    public function lists()
    {
        $admins = Admin::paginate();
        return $admins;
    }
}