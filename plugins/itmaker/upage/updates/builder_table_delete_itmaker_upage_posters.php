<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteItmakerUpagePosters extends Migration
{
    public function up()
    {
        Schema::dropIfExists('itmaker_upage_posters');
    }
    
    public function down()
    {
        Schema::create('itmaker_upage_posters', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 191);
            $table->text('anounce');
            $table->text('description');
            $table->dateTime('date')->nullable();
            $table->string('video_url', 191);
            $table->text('timetable');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->boolean('is_active');
            $table->integer('sort_order')->nullable()->unsigned();
        });
    }
}
