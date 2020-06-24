<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpagePosters extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_posters', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('anounce');
            $table->text('description');
            $table->dateTime('date')->nullable();
            $table->string('video_url');
            $table->text('timetable');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_posters');
    }
}
