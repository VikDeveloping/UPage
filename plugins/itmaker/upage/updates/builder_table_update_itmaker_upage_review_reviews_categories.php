<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageReviewReviewsCategories extends Migration
{
    public function up()
    {
        Schema::rename('itmaker_upage_review_category', 'itmaker_upage_review_reviews_categories');
    }
    
    public function down()
    {
        Schema::rename('itmaker_upage_review_reviews_categories', 'itmaker_upage_review_category');
    }
}
