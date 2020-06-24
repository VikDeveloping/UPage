<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageCompanySchedules extends Migration
{
    public function up()
    {
        Schema::rename('itmaker_upage_company_scedules', 'itmaker_upage_company_schedules');
    }
    
    public function down()
    {
        Schema::rename('itmaker_upage_company_schedules', 'itmaker_upage_company_scedules');
    }
}
