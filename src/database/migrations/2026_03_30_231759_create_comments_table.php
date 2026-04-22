<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        // 誰が投稿したか
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // どの商品への投稿か
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        // コメント内容
        $table->text('comment');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
