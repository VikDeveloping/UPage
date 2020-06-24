<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanies19 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->string('region_code', 110)->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_companies', function($table)
        {
            $table->string('region_code', 10)->change();
        });
    }
}
