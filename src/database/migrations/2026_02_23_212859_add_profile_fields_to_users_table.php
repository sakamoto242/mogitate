<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // imageカラムがなければ追加
            if (!Schema::hasColumn('users', 'image')) {
                $table->string('image')->nullable()->after('email');
            }
            // post_codeカラムがなければ追加
            if (!Schema::hasColumn('users', 'post_code')) {
                $table->string('post_code')->nullable()->after('image');
            }
            // addressカラムがなければ追加
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable()->after('post_code');
            }
            // buildingカラムがなければ追加
            if (!Schema::hasColumn('users', 'building')) {
                $table->string('building')->nullable()->after('address');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 削除時も存在確認をしてから消すと安全です
            $columns = ['image', 'post_code', 'address', 'building'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
