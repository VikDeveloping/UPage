<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageReviewReviews2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_review_reviews', function($table)
        {
            $table->decimal('coor_lat', 12, 10);
            $table->decimal('coor_long', 12, 10);
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_review_reviews', function($table)
        {
            $table->dropColumn('coor_lat');
            $table->dropColumn('coor_long');
        });
    }
}
