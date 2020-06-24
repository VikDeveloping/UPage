<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpagePosters2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_posters', function($table)
        {
            $table->integer('sort_order')->nullable()->unsigned();
            $table->string('name')->change();
            $table->string('video_url')->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_posters', function($table)
        {
            $table->dropColumn('sort_order');
            $table->string('name', 191)->change();
            $table->string('video_url', 191)->change();
        });
    }
}
