<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpagePosters extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_posters', function($table)
        {
            $table->boolean('is_active');
            $table->increments('id')->unsigned(false)->change();
            $table->string('name')->change();
            $table->string('video_url')->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_posters', function($table)
        {
            $table->dropColumn('is_active');
            $table->increments('id')->unsigned()->change();
            $table->string('name', 191)->change();
            $table->string('video_url', 191)->change();
        });
    }
}
