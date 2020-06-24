<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpageCategoryViews extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_category_views', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('category_id');
            $table->integer('views');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_category_views');
    }
}
