<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageReviewReviewCategories2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_review_review_categories', function($table)
        {
            $table->renameColumn('category_id', 'review_category_id');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_review_review_categories', function($table)
        {
            $table->renameColumn('review_category_id', 'category_id');
        });
    }
}
