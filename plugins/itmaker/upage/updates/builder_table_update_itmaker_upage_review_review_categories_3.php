<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageReviewReviewCategories3 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_review_review_categories', function($table)
        {
            $table->renameColumn('review_id', 'review_review_id');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_review_review_categories', function($table)
        {
            $table->renameColumn('review_review_id', 'review_id');
        });
    }
}
