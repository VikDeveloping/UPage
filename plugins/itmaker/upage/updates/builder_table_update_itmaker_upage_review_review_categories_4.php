<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageReviewReviewCategories4 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_review_review_categories', function($table)
        {
            $table->integer('review_category_id')->unsigned(false)->change();
            $table->integer('review_review_id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_review_review_categories', function($table)
        {
            $table->integer('review_category_id')->unsigned()->change();
            $table->integer('review_review_id')->unsigned()->change();
        });
    }
}
