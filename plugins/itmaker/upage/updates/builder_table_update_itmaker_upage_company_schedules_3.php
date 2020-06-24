<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanySchedules3 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_company_schedules', function($table)
        {
            $table->integer('company_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_company_schedules', function($table)
        {
            $table->integer('company_id')->nullable(false)->change();
        });
    }
}
