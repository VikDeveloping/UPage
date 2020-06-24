<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpageCompanyReviews extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_company_reviews', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('company_id');
            $table->integer('user_id');
            $table->text('review');
            $table->integer('rating');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_company_reviews');
    }
}
