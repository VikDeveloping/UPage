<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteItmakerUpageReviewReviews extends Migration
{
    public function up()
    {
        Schema::dropIfExists('itmaker_upage_review_reviews');
    }
    
    public function down()
    {
        Schema::create('itmaker_upage_review_reviews', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('email', 191)->nullable();
            $table->string('title', 191)->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('user_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->decimal('coor_lat', 12, 10);
            $table->decimal('coor_long', 12, 10);
        });
    }
}
