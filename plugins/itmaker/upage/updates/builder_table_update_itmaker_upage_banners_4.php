<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageBanners4 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_banners', function($table)
        {
            $table->text('url');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_banners', function($table)
        {
            $table->dropColumn('url');
        });
    }
}
