<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageReviewReviewCategories extends Migration
{
    public function up()
    {
        Schema::rename('itmaker_upage_review_reviews_categories', 'itmaker_upage_review_review_categories');
    }
    
    public function down()
    {
        Schema::rename('itmaker_upage_review_review_categories', 'itmaker_upage_review_reviews_categories');
    }
}
