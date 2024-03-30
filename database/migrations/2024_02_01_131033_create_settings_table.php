<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi');
            $table->string('token');
            $table->date('tgl_expired');
            $table->integer('biaya_admin');
            $table->timestamps();
        });

        Setting::create([
            'nama_aplikasi' => 'Taniline',
            'token' => '123456',
            'tgl_expired' => '2025-12-31',
            'biaya_admin' => 2000
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
