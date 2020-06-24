<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteItmakerUpageRegions extends Migration
{
    public function up()
    {
        Schema::dropIfExists('itmaker_upage_regions');
    }
    
    public function down()
    {
        Schema::create('itmaker_upage_regions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 191);
            $table->text('description');
            $table->boolean('is_active');
            $table->integer('city_id')->nullable();
            $table->integer('sort_order')->nullable()->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
}
