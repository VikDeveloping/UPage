<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageInterestings extends Migration
{
    public function up()
    {
        Schema::rename('itmaker_upage_interesting', 'itmaker_upage_interestings');
        Schema::table('itmaker_upage_interestings', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
            $table->string('type')->change();
        });
    }
    
    public function down()
    {
        Schema::rename('itmaker_upage_interestings', 'itmaker_upage_interesting');
        Schema::table('itmaker_upage_interesting', function($table)
        {
            $table->increments('id')->unsigned()->change();
            $table->string('type', 191)->change();
        });
    }
}
