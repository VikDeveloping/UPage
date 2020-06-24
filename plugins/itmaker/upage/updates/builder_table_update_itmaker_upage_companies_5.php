<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanies5 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->integer('location_id')->nullable()->unsigned();
            $table->dropColumn('city_id');
            $table->dropColumn('region_id');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->dropColumn('location_id');
            $table->integer('city_id')->nullable()->unsigned();
            $table->integer('region_id')->nullable()->unsigned();
        });
    }
}
