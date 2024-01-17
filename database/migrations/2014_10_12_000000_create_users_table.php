<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('number_telephone')->nullable();
            $table->string('username')->nullable();
            $table->string('password');
            $table->enum('level', ['1', '2', '3', '4', '5', '6', '7', '8', '9']);
            $table->string('nis_nip')->nullable();
            $table->integer('id_perusahaan')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'number_telephone' => '08773736629',
            'username' => 'admin',
            'password' =>   Hash::make('123456'),
            'level' => '1',
            'nis_nip' => '123'
        ]);

        User::create([
            'name' => 'bank_ntbs',
            'email' => 'callcenter@bankntb.co.id',
            'number_telephone' => '(0370) 636331',
            'username' => 'bank_ntbs',
            'password' =>   Hash::make('bank_ntbs_123456'),
            'level' => '9',
            'nis_nip' => '-'
        ]);
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
