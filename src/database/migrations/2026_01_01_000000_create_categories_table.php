<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration // クラス名を変更
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) { // テーブル名をcategoriesに変更
            $table->id();
            $table->string('content'); // カラムはこれだけでOK
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}