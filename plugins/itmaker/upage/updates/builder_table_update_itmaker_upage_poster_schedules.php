<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpagePosterSchedules extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_poster_schedules', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
            $table->string('cinema')->change();
            $table->dateTime('start')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_poster_schedules', function($table)
        {
            $table->increments('id')->unsigned()->change();
            $table->string('cinema', 191)->change();
            $table->time('start')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
