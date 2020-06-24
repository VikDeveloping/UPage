<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageLocations extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_locations', function($table)
        {
            $table->string('name')->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_locations', function($table)
        {
            $table->string('name', 191)->change();
        });
    }
}
