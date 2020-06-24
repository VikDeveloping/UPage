<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanySchedules2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_company_schedules', function($table)
        {
            $table->integer('company_id');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_company_schedules', function($table)
        {
            $table->dropColumn('company_id');
        });
    }
}
