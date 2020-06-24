<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpagePosterSchedules3 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_poster_schedules', function($table)
        {
            $table->dateTime('start')->nullable();
            $table->dropColumn('date');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_poster_schedules', function($table)
        {
            $table->dropColumn('start');
            $table->date('date')->nullable();
        });
    }
}
