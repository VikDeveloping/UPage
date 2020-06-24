<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteItmakerUpageReviewCategories extends Migration
{
    public function up()
    {
        Schema::dropIfExists('itmaker_upage_review_categories');
    }
    
    public function down()
    {
        Schema::create('itmaker_upage_review_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(1);
            $table->smallInteger('sort_order')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
}
