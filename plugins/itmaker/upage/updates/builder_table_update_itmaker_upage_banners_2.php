<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageBanners2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_banners', function($table)
        {
            $table->integer('views')->nullable();
            $table->integer('clicks')->nullable();
            $table->dropColumn('this_page');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_banners', function($table)
        {
            $table->dropColumn('views');
            $table->dropColumn('clicks');
            $table->string('this_page', 191);
        });
    }
}
