<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBuyerIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        // 購入したユーザーのIDを保存するカラム（空のときは未購入）
        $table->foreignId('buyer_id')->nullable()->constrained('users');
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['buyer_id']);
        $table->dropColumn('buyer_id');
    });
}
}
