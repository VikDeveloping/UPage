<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageReviewsCategories extends Migration
{
    public function up()
    {
        Schema::rename('itmaker_upage_reviews_reviews', 'itmaker_upage_reviews_categories');
    }
    
    public function down()
    {
        Schema::rename('itmaker_upage_reviews_categories', 'itmaker_upage_reviews_reviews');
    }
}
