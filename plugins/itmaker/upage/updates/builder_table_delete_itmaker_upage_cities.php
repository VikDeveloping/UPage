<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteItmakerUpageCities extends Migration
{
    public function up()
    {
        Schema::dropIfExists('itmaker_upage_cities');
    }
    
    public function down()
    {
        Schema::create('itmaker_upage_cities', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 191);
            $table->text('description');
            $table->integer('sort_order')->nullable()->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('is_active');
        });
    }
}
