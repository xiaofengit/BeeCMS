<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminToAdminsTable extends Migration
{
    protected $email = 'admin@xiaofengit.com';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('admins')->insert([
            'email' => $this->email,
            'password' => bcrypt($this->email),
            'name' => 'Super Admin',
            'is_super' => 1,
            'is_active' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admins')->where('email', '=', $this->email)->delete();
    }
}
