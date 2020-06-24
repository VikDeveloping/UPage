<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpagePosterSchedules2 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_poster_schedules', function($table)
        {
            $table->date('date')->nullable();
            $table->dropColumn('start');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_poster_schedules', function($table)
        {
            $table->dropColumn('date');
            $table->dateTime('start')->nullable();
        });
    }
}
