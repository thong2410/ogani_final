<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostTableAndBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('cate_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->increments('post_id');
            $table->integer('cate_id')->unsigned();
            $table->integer('thumb_id')->unsigned();
            $table->string('post_title');
            $table->text('post_content');
            $table->string('seo_title', 150);
            $table->mediumText('seo_description');
            $table->mediumText('seo_keywords');           
            $table->timestamps();

            $table->foreign('thumb_id')->references('id')->on('media');
            $table->foreign('cate_id')->references('cate_id')->on('blog_categories');
        });

        Schema::create('blog_comments', function (Blueprint $table) {
            $table->increments('comment_id');
            $table->integer('post_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('message');
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('post_id')->references('post_id')->on('blog_posts');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blog_posts');
        Schema::drop('blog_categories');
        Schema::drop('blog_comments');
    }
}
