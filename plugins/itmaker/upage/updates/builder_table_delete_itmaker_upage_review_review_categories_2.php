<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteItmakerUpageReviewReviewCategories2 extends Migration
{
    public function up()
    {
        Schema::dropIfExists('itmaker_upage_review_review_categories');
    }
    
    public function down()
    {
        Schema::create('itmaker_upage_review_review_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('review_category_id');
            $table->integer('review_review_id');
        });
    }
}
