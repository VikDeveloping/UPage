<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCities extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_cities', function($table)
        {
            $table->boolean('is_active');
            $table->increments('id')->unsigned(false)->change();
            $table->string('name')->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_cities', function($table)
        {
            $table->dropColumn('is_active');
            $table->increments('id')->unsigned()->change();
            $table->string('name', 191)->change();
        });
    }
}
