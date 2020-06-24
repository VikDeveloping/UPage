<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpagePosters3 extends Migration
{
    public function up()
    {
        Schema::rename('itmaker_upage_', 'itmaker_upage_posters');
        Schema::table('itmaker_upage_posters', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
            $table->string('name')->change();
            $table->string('video_url')->change();
        });
    }
    
    public function down()
    {
        Schema::rename('itmaker_upage_posters', 'itmaker_upage_');
        Schema::table('itmaker_upage_', function($table)
        {
            $table->increments('id')->unsigned()->change();
            $table->string('name', 191)->change();
            $table->string('video_url', 191)->change();
        });
    }
}
