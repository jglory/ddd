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
            $table->bigInteger('id', false, true);
            $table->bigInteger('article_id', false, true)->nullable()->comment('게시물 아이디');
            $table->string('comment', 1000)->comment('내용');
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
            $table->index('article_id');
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
