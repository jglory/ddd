<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigInteger('id', false, true);
            $table->bigInteger('writer_id', false, true)->nullable()->comment('게시자 아이디');
            $table->string('title', 500)->comment('타이틀');
            $table->text('content')->comment('내용');
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
            $table->index('writer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
