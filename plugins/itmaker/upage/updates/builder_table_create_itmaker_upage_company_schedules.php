<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateItmakerUpageCompanySchedules extends Migration
{
    public function up()
    {
        Schema::create('itmaker_upage_company_schedules', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('itmaker_upage_company_schedules');
    }
}
