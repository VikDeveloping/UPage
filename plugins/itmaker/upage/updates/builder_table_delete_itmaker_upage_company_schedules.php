<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteItmakerUpageCompanySchedules extends Migration
{
    public function up()
    {
        Schema::dropIfExists('itmaker_upage_company_schedules');
    }
    
    public function down()
    {
        Schema::create('itmaker_upage_company_schedules', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
        });
    }
}
