<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->integer('post_id');
            $table->bigIncrements('review_id');
            $table->string('book_title');
            $table->string('book_summary');
            $table->string('book_author');
            $table->float('rating');
            $table->integer('book_number_of_pages');
            $table->string('book_publisher');
            $table->string('book_series');
            $table->string('book_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
