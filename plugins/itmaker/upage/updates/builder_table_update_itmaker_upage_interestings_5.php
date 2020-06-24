<?php namespace Itmaker\Upage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateItmakerUpageInterestings5 extends Migration
{
    public function up()
    {
        Schema::table('itmaker_upage_interestings', function($table)
        {
            $table->dropColumn('view');
        });
    }
    
    public function down()
    {
        Schema::table('itmaker_upage_interestings', function($table)
        {
            $table->integer('view')->nullable();
        });
    }
}
