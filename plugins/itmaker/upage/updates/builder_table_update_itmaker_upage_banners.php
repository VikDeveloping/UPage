<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageBanners extends Migration
{
    public function up()
    {
        Schema::rename('itmaker_upage_', 'itmaker_upage_banners');
        Schema::table('itmaker_upage_banners', function($table)
        {
            $table->string('name')->change();
            $table->string('this_page')->change();
        });
    }
    
    public function down()
    {
        Schema::rename('itmaker_upage_banners', 'itmaker_upage_');
        Schema::table('itmaker_upage_', function($table)
        {
            $table->string('name', 191)->change();
            $table->string('this_page', 191)->change();
        });
    }
}
