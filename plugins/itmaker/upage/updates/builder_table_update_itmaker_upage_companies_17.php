<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanies17 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->decimal('coor_lat', 16, 14)->change();
            $table->decimal('coor_long', 16, 14)->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->decimal('coor_lat', 8, 6)->change();
            $table->decimal('coor_long', 8, 6)->change();
        });
    }
}
