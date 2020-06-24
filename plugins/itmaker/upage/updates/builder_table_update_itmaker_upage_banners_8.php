<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageBanners8 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_banners', function($table)
        {
            $table->integer('views')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_banners', function($table)
        {
            $table->integer('views')->nullable(false)->change();
        });
    }
}
