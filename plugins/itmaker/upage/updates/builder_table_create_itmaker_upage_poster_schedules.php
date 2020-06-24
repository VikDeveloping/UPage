<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpagePosterSchedules extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_poster_schedules', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('cinema');
            $table->time('start')->nullable();
            $table->integer('poster_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_poster_schedules');
    }
}
